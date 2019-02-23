<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @UniqueEntity("studentNumber")
 */
class User implements UserInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=14, unique=true)
     *
     */
    private $studentNumber;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @ORM\Column(type="string", length=32)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=4, nullable=true)
     * @Assert\Choice(choices={"male", "fema"}, message="Choose a valid gender.")
     */
    private $gender;

    /**
     * @ORM\Column(type="string", length=11, nullable=true)
     * @Assert\Regex("/^(13[0-9]|14[5-9]|15[012356789]|166|17[0-8]|18[0-9]|19[8-9])[0-9]{8}$/", message="Provide a valid phone number.")
     */
    private $phoneNumber;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $college;

    /**
     * @ORM\Column(type="string", length=20, nullable=true)
     * @Assert\NotBlank
     */
    private $roomNumber;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\TimeCell", mappedBy="applicants")
     */
    private $appliedTimeCells;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Attendance", mappedBy="owner", orphanRemoval=true)
     */
    private $attendances;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Attendance", cascade={"persist", "remove"})
     */
    private $currentAttendance;

    public function __construct()
    {
        $this->appliedTimeCells = new ArrayCollection();
        $this->attendances = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStudentNumber(): ?string
    {
        return $this->studentNumber;
    }

    public function setStudentNumber(string $studentNumber): self
    {
        $this->studentNumber = $studentNumber;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getGender(): ?string
    {
        return $this->gender;
    }

    public function setGender(string $gender): self
    {
        $this->gender = $gender;

        return $this;
    }

    public function getPhoneNumber(): ?string
    {
        return $this->phoneNumber;
    }

    public function setPhoneNumber(string $phoneNumber): self
    {
        $this->phoneNumber = $phoneNumber;

        return $this;
    }

    public function getCollege(): ?string
    {
        return $this->college;
    }

    public function setCollege(string $college): self
    {
        $this->college = $college;

        return $this;
    }

    public function getRoomNumber(): ?string
    {
        return $this->roomNumber;
    }

    public function setRoomNumber(string $roomNumber): self
    {
        $this->roomNumber = $roomNumber;

        return $this;
    }
    
    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->studentNumber;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword()
    {
        // not needed for apps that do not check user passwords
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed for apps that do not check user passwords
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    /**
     * @return Collection|TimeCell[]
     */
    public function getAppliedTimeCells(): Collection
    {
        return $this->appliedTimeCells;
    }

    public function addAppliedTimeCell(TimeCell $appliedTimeCell): self
    {
        if (!$this->appliedTimeCells->contains($appliedTimeCell)) {
            $this->appliedTimeCells[] = $appliedTimeCell;
            $appliedTimeCell->addApplicant($this);
        }

        return $this;
    }

    public function removeAppliedTimeCell(TimeCell $appliedTimeCell): self
    {
        if ($this->appliedTimeCells->contains($appliedTimeCell)) {
            $this->appliedTimeCells->removeElement($appliedTimeCell);
            $appliedTimeCell->removeApplicant($this);
        }

        return $this;
    }

    /**
     * @return Collection|Attendance[]
     */
    public function getAttendances(): Collection
    {
        return $this->attendances;
    }

    public function addAttendance(Attendance $attendance): self
    {
        if (!$this->attendances->contains($attendance)) {
            $this->attendances[] = $attendance;
            $attendance->setOwner($this);
        }

        return $this;
    }

    public function removeAttendance(Attendance $attendance): self
    {
        if ($this->attendances->contains($attendance)) {
            $this->attendances->removeElement($attendance);
            // set the owning side to null (unless already changed)
            if ($attendance->getOwner() === $this) {
                $attendance->setOwner(null);
            }
        }

        return $this;
    }

    public function getCurrentAttendance(): ?Attendance
    {
        return $this->currentAttendance;
    }

    public function setCurrentAttendance(?Attendance $currentAttendance): self
    {
        $this->currentAttendance = $currentAttendance;

        return $this;
    }
}
