<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AttendanceRepository")
 */
class Attendance
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $signInTime;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $signOutTime;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="attendances")
     * @ORM\JoinColumn(nullable=false)
     */
    private $owner;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSignInTime(): ?\DateTimeInterface
    {
        return $this->signInTime;
    }

    public function setSignInTime(\DateTimeInterface $signInTime): self
    {
        $this->signInTime = $signInTime;

        return $this;
    }

    public function getSignOutTime(): ?\DateTimeInterface
    {
        return $this->signOutTime;
    }

    public function setSignOutTime(?\DateTimeInterface $signOutTime): self
    {
        $this->signOutTime = $signOutTime;

        return $this;
    }

    public function getOwner(): ?User
    {
        return $this->owner;
    }

    public function setOwner(?User $owner): self
    {
        $this->owner = $owner;

        return $this;
    }
}
