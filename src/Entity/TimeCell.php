<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TimeCellRepository")
 */
class TimeCell
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Recruitment", inversedBy="timeCells")
     * @ORM\JoinColumn(nullable=false)
     */
    private $recruitment;

    /**
     * @ORM\Column(type="integer")
     */
    private $rowNumber;

    /**
     * @ORM\Column(type="integer")
     */
    private $columnNumber;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\User", inversedBy="applicatedTimeCells")
     */
    private $applicants;

    /**
     * @ORM\Column(type="integer")
     */
    private $demand;

    public function __construct()
    {
        $this->applicants = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRecruitment(): ?Recruitment
    {
        return $this->recruitment;
    }

    public function setRecruitment(?Recruitment $recruitment): self
    {
        $this->recruitment = $recruitment;

        return $this;
    }

    public function getRowNumber(): ?int
    {
        return $this->rowNumber;
    }

    public function setRowNumber(int $rowNumber): self
    {
        $this->rowNumber = $rowNumber;

        return $this;
    }

    public function getColumnNumber(): ?int
    {
        return $this->columnNumber;
    }

    public function setColumnNumber(int $columnNumber): self
    {
        $this->columnNumber = $columnNumber;

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getApplicants(): Collection
    {
        return $this->applicants;
    }

    public function addApplicant(User $applicant): self
    {
        if (!$this->applicants->contains($applicant)) {
            $this->applicants[] = $applicant;
        }

        return $this;
    }

    public function removeApplicant(User $applicant): self
    {
        if ($this->applicants->contains($applicant)) {
            $this->applicants->removeElement($applicant);
        }

        return $this;
    }

    public function getDemand(): ?int
    {
        return $this->demand;
    }

    public function setDemand(int $demand): self
    {
        $this->demand = $demand;

        return $this;
    }
}
