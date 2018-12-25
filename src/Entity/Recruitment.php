<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\RecruitmentRepository")
 */
class Recruitment
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $name;

    /**
     * @ORM\Column(type="array")
     */
    private $timeTableRows = [];

    /**
     * @ORM\Column(type="array")
     */
    private $timeTableColumns = [];

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\TimeCell", mappedBy="recruitment", orphanRemoval=true)
     */
    private $timeCells;

    public function __construct()
    {
        $this->timeCells = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getTimeTableRows(): ?array
    {
        return $this->timeTableRows;
    }

    public function setTimeTableRows($timeTableRows): self
    {
        if (is_string($timeTableRows)) {
            $timeTableRows = preg_split('/,/', $timeTableRows);
        }

        $this->timeTableRows = $timeTableRows;

        return $this;
    }

    public function getTimeTableColumns(): ?array
    {
        return $this->timeTableColumns;
    }

    public function setTimeTableColumns($timeTableColumns): self
    {
        if (is_string($timeTableColumns)) {
            $timeTableColumns = preg_split('/,/', $timeTableColumns);
        }

        $this->timeTableColumns = $timeTableColumns;

        return $this;
    }

    /**
     * @return Collection|TimeCell[]
     */
    public function getTimeCells(): Collection
    {
        return $this->timeCells;
    }

    public function addTimeCell(TimeCell $timeCell): self
    {
        if (!$this->timeCells->contains($timeCell)) {
            $this->timeCells[] = $timeCell;
            $timeCell->setRecruitment($this);
        }

        return $this;
    }

    public function removeTimeCell(TimeCell $timeCell): self
    {
        if ($this->timeCells->contains($timeCell)) {
            $this->timeCells->removeElement($timeCell);
            // set the owning side to null (unless already changed)
            if ($timeCell->getRecruitment() === $this) {
                $timeCell->setRecruitment(null);
            }
        }

        return $this;
    }
}
