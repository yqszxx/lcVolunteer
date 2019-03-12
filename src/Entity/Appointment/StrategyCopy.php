<?php

namespace App\Entity\Appointment;

use Doctrine\ORM\Mapping as ORM;

/**
 * StrategyCopy
 *
 * @ORM\Table(name="strategy_copy")
 * @ORM\Entity
 */
class StrategyCopy
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
     * @var bool
     *
     * @ORM\Column(name="enabled", type="boolean", nullable=false, options={"default"="1"})
     */
    private $enabled = '1';

    /**
     * @var int
     *
     * @ORM\Column(name="pre_days", type="integer", nullable=false, options={"unsigned"=true})
     */
    private $preDays;

    /**
     * @var string|null
     *
     * @ORM\Column(name="days", type="string", length=255, nullable=true)
     */
    private $days;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="end_at", type="datetime", nullable=true)
     */
    private $endAt;

    /**
     * @var int
     *
     * @ORM\Column(name="least_ahead", type="integer", nullable=false, options={"unsigned"=true,"comment"="单位：分钟"})
     */
    private $leastAhead;

    /**
     * @var int
     *
     * @ORM\Column(name="least_credits", type="integer", nullable=false)
     */
    private $leastCredits;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="start_time", type="time", nullable=false)
     */
    private $startTime;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="end_time", type="time", nullable=false)
     */
    private $endTime;

    /**
     * @var int|null
     *
     * @ORM\Column(name="minutes_per_slice", type="integer", nullable=true)
     */
    private $minutesPerSlice;

    /**
     * @var int|null
     *
     * @ORM\Column(name="min_slices", type="integer", nullable=true)
     */
    private $minSlices;

    /**
     * @var int|null
     *
     * @ORM\Column(name="max_slices", type="integer", nullable=true)
     */
    private $maxSlices;

    /**
     * @var int
     *
     * @ORM\Column(name="points", type="integer", nullable=false)
     */
    private $points;

    /**
     * @var bool
     *
     * @ORM\Column(name="need_sign", type="boolean", nullable=false)
     */
    private $needSign;

    /**
     * @var int|null
     *
     * @ORM\Column(name="refresh_interval", type="integer", nullable=true)
     */
    private $refreshInterval;

    /**
     * @var int|null
     *
     * @ORM\Column(name="sign_in_before", type="integer", nullable=true)
     */
    private $signInBefore;

    /**
     * @var int|null
     *
     * @ORM\Column(name="sign_in_after", type="integer", nullable=true)
     */
    private $signInAfter;

    /**
     * @var int|null
     *
     * @ORM\Column(name="sign_out_before", type="integer", nullable=true)
     */
    private $signOutBefore;

    /**
     * @var int|null
     *
     * @ORM\Column(name="sign_out_after", type="integer", nullable=true)
     */
    private $signOutAfter;

    /**
     * @var int|null
     *
     * @ORM\Column(name="not_sign_in_credits", type="integer", nullable=true)
     */
    private $notSignInCredits;

    /**
     * @var int|null
     *
     * @ORM\Column(name="not_sign_out_credits", type="integer", nullable=true)
     */
    private $notSignOutCredits;

    /**
     * @var int
     *
     * @ORM\Column(name="is_deleted", type="integer", nullable=false)
     */
    private $isDeleted = '0';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="create_time", type="datetime", nullable=false, options={"default"="CURRENT_TIMESTAMP"})
     */
    private $createTime = 'CURRENT_TIMESTAMP';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="modified_time", type="datetime", nullable=false, options={"default"="CURRENT_TIMESTAMP"})
     */
    private $modifiedTime = 'CURRENT_TIMESTAMP';

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEnabled(): ?bool
    {
        return $this->enabled;
    }

    public function setEnabled(bool $enabled): self
    {
        $this->enabled = $enabled;

        return $this;
    }

    public function getPreDays(): ?int
    {
        return $this->preDays;
    }

    public function setPreDays(int $preDays): self
    {
        $this->preDays = $preDays;

        return $this;
    }

    public function getDays(): ?string
    {
        return $this->days;
    }

    public function setDays(?string $days): self
    {
        $this->days = $days;

        return $this;
    }

    public function getEndAt(): ?\DateTimeInterface
    {
        return $this->endAt;
    }

    public function setEndAt(?\DateTimeInterface $endAt): self
    {
        $this->endAt = $endAt;

        return $this;
    }

    public function getLeastAhead(): ?int
    {
        return $this->leastAhead;
    }

    public function setLeastAhead(int $leastAhead): self
    {
        $this->leastAhead = $leastAhead;

        return $this;
    }

    public function getLeastCredits(): ?int
    {
        return $this->leastCredits;
    }

    public function setLeastCredits(int $leastCredits): self
    {
        $this->leastCredits = $leastCredits;

        return $this;
    }

    public function getStartTime(): ?\DateTimeInterface
    {
        return $this->startTime;
    }

    public function setStartTime(\DateTimeInterface $startTime): self
    {
        $this->startTime = $startTime;

        return $this;
    }

    public function getEndTime(): ?\DateTimeInterface
    {
        return $this->endTime;
    }

    public function setEndTime(\DateTimeInterface $endTime): self
    {
        $this->endTime = $endTime;

        return $this;
    }

    public function getMinutesPerSlice(): ?int
    {
        return $this->minutesPerSlice;
    }

    public function setMinutesPerSlice(?int $minutesPerSlice): self
    {
        $this->minutesPerSlice = $minutesPerSlice;

        return $this;
    }

    public function getMinSlices(): ?int
    {
        return $this->minSlices;
    }

    public function setMinSlices(?int $minSlices): self
    {
        $this->minSlices = $minSlices;

        return $this;
    }

    public function getMaxSlices(): ?int
    {
        return $this->maxSlices;
    }

    public function setMaxSlices(?int $maxSlices): self
    {
        $this->maxSlices = $maxSlices;

        return $this;
    }

    public function getPoints(): ?int
    {
        return $this->points;
    }

    public function setPoints(int $points): self
    {
        $this->points = $points;

        return $this;
    }

    public function getNeedSign(): ?bool
    {
        return $this->needSign;
    }

    public function setNeedSign(bool $needSign): self
    {
        $this->needSign = $needSign;

        return $this;
    }

    public function getRefreshInterval(): ?int
    {
        return $this->refreshInterval;
    }

    public function setRefreshInterval(?int $refreshInterval): self
    {
        $this->refreshInterval = $refreshInterval;

        return $this;
    }

    public function getSignInBefore(): ?int
    {
        return $this->signInBefore;
    }

    public function setSignInBefore(?int $signInBefore): self
    {
        $this->signInBefore = $signInBefore;

        return $this;
    }

    public function getSignInAfter(): ?int
    {
        return $this->signInAfter;
    }

    public function setSignInAfter(?int $signInAfter): self
    {
        $this->signInAfter = $signInAfter;

        return $this;
    }

    public function getSignOutBefore(): ?int
    {
        return $this->signOutBefore;
    }

    public function setSignOutBefore(?int $signOutBefore): self
    {
        $this->signOutBefore = $signOutBefore;

        return $this;
    }

    public function getSignOutAfter(): ?int
    {
        return $this->signOutAfter;
    }

    public function setSignOutAfter(?int $signOutAfter): self
    {
        $this->signOutAfter = $signOutAfter;

        return $this;
    }

    public function getNotSignInCredits(): ?int
    {
        return $this->notSignInCredits;
    }

    public function setNotSignInCredits(?int $notSignInCredits): self
    {
        $this->notSignInCredits = $notSignInCredits;

        return $this;
    }

    public function getNotSignOutCredits(): ?int
    {
        return $this->notSignOutCredits;
    }

    public function setNotSignOutCredits(?int $notSignOutCredits): self
    {
        $this->notSignOutCredits = $notSignOutCredits;

        return $this;
    }

    public function getIsDeleted(): ?int
    {
        return $this->isDeleted;
    }

    public function setIsDeleted(int $isDeleted): self
    {
        $this->isDeleted = $isDeleted;

        return $this;
    }

    public function getCreateTime(): ?\DateTimeInterface
    {
        return $this->createTime;
    }

    public function setCreateTime(\DateTimeInterface $createTime): self
    {
        $this->createTime = $createTime;

        return $this;
    }

    public function getModifiedTime(): ?\DateTimeInterface
    {
        return $this->modifiedTime;
    }

    public function setModifiedTime(\DateTimeInterface $modifiedTime): self
    {
        $this->modifiedTime = $modifiedTime;

        return $this;
    }


}
