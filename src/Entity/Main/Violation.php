<?php

namespace App\Entity\Main;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\Main\ViolationRepository")
 */
class Violation
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $bookingId;

    /**
     * @ORM\Column(type="text")
     */
    private $reason;

    /**
     * @ORM\Column(type="datetime")
     */
    private $time;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Main\User")
     * @ORM\JoinColumn(nullable=false)
     */
    private $volunteer;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBookingId(): ?int
    {
        return $this->bookingId;
    }

    public function setBookingId(int $bookingId): self
    {
        $this->bookingId = $bookingId;

        return $this;
    }

    public function getReason(): ?string
    {
        return $this->reason;
    }

    public function setReason(string $reason): self
    {
        $this->reason = $reason;

        return $this;
    }

    public function getTime(): ?\DateTimeInterface
    {
        return $this->time;
    }

    public function setTime(\DateTimeInterface $time): self
    {
        $this->time = $time;

        return $this;
    }

    public function getVolunteer(): ?User
    {
        return $this->volunteer;
    }

    public function setVolunteer(?User $volunteer): self
    {
        $this->volunteer = $volunteer;

        return $this;
    }
}
