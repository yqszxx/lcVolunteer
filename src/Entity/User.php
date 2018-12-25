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
     * @Assert\NotBlank
     * @Assert\Length(min=14, max=14, exactMessage="Your student number must be exact {{ limit }} long.")
     *
     */
    private $studentNumber;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @ORM\Column(type="string", length=32)
     * @Assert\NotBlank
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=4)
     * @Assert\NotBlank
     * @Assert\Choice(choices={"male", "fema"}, message="Choose a valid gender.")
     */
    private $gender;

    /**
     * @ORM\Column(type="string", length=11)
     * @Assert\NotBlank
     * @Assert\Regex("/^(13[0-9]|14[5-9]|15[012356789]|166|17[0-8]|18[0-9]|19[8-9])[0-9]{8}$/", message="Provide a valid phone number.")
     */
    private $phoneNumber;

    /**
     * @ORM\Column(type="string", length=50)
     * @Assert\NotBlank
     */
    private $college;

    /**
     * @ORM\Column(type="string", length=4)
     * @Assert\NotBlank
     * @Assert\Choice(choices={"udg", "gra"}, message="Choose a valid grade.")
     */
    private $grade;

    /**
     * @ORM\Column(type="string", length=20)
     * @Assert\NotBlank
     */
    private $roomNumber;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\TimeCell", mappedBy="applicants")
     */
    private $appliedTimeCells;

    public function __construct()
    {
        $this->appliedTimeCells = new ArrayCollection();
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

    public function getGrade(): ?string
    {
        return $this->grade;
    }

    public function setGrade(string $grade): self
    {
        $this->grade = $grade;

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
}