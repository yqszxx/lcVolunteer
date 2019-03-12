<?php

namespace App\Entity\Appointment;

use Doctrine\ORM\Mapping as ORM;

/**
 * CreditsLog
 *
 * @ORM\Table(name="credits_log")
 * @ORM\Entity
 */
class CreditsLog
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="bigint", nullable=false, options={"unsigned"=true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="user_id", type="bigint", nullable=false)
     */
    private $userId;

    /**
     * @var int|null
     *
     * @ORM\Column(name="relational_id", type="bigint", nullable=true)
     */
    private $relationalId;

    /**
     * @var string
     *
     * @ORM\Column(name="reason", type="string", length=255, nullable=false)
     */
    private $reason = '';

    /**
     * @var int
     *
     * @ORM\Column(name="credits_before", type="integer", nullable=false)
     */
    private $creditsBefore;

    /**
     * @var int
     *
     * @ORM\Column(name="credits_delta", type="integer", nullable=false)
     */
    private $creditsDelta;

    /**
     * @var int
     *
     * @ORM\Column(name="credits_after", type="integer", nullable=false)
     */
    private $creditsAfter;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="gmt_create", type="datetime", nullable=true, options={"default"="CURRENT_TIMESTAMP"})
     */
    private $gmtCreate = 'CURRENT_TIMESTAMP';

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUserId(): ?int
    {
        return $this->userId;
    }

    public function setUserId(int $userId): self
    {
        $this->userId = $userId;

        return $this;
    }

    public function getRelationalId(): ?int
    {
        return $this->relationalId;
    }

    public function setRelationalId(?int $relationalId): self
    {
        $this->relationalId = $relationalId;

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

    public function getCreditsBefore(): ?int
    {
        return $this->creditsBefore;
    }

    public function setCreditsBefore(int $creditsBefore): self
    {
        $this->creditsBefore = $creditsBefore;

        return $this;
    }

    public function getCreditsDelta(): ?int
    {
        return $this->creditsDelta;
    }

    public function setCreditsDelta(int $creditsDelta): self
    {
        $this->creditsDelta = $creditsDelta;

        return $this;
    }

    public function getCreditsAfter(): ?int
    {
        return $this->creditsAfter;
    }

    public function setCreditsAfter(int $creditsAfter): self
    {
        $this->creditsAfter = $creditsAfter;

        return $this;
    }

    public function getGmtCreate(): ?\DateTimeInterface
    {
        return $this->gmtCreate;
    }

    public function setGmtCreate(?\DateTimeInterface $gmtCreate): self
    {
        $this->gmtCreate = $gmtCreate;

        return $this;
    }


}
