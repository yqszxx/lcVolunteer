<?php

namespace App\Entity\Appointment;

use Doctrine\ORM\Mapping as ORM;

/**
 * BookingRecord
 *
 * @ORM\Table(name="booking_record", indexes={@ORM\Index(name="idx_state", columns={"state"})})
 * @ORM\Entity(repositoryClass="App\Repository\Appointment\BookingRecordRepository")
 */
class BookingRecord
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
     * @var int|null
     *
     * @ORM\Column(name="user_id", type="bigint", nullable=true, options={"unsigned"=true,"comment"="预约者id"})
     */
    private $userId;

    /**
     * @var int|null
     *
     * @ORM\Column(name="resource_id", type="bigint", nullable=true, options={"unsigned"=true})
     */
    private $resourceId;

    const SelfStudyRoom = 1;
    const ConferenceRoom = 2;

    /**
     * @var int|null
     *
     * @ORM\Column(name="resource_type", type="integer", nullable=true, options={"comment"="预约的资源类型，1表示自习室座位，2表示会议室，3表示创客空间"})
     */
    private $resourceType;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="start_time", type="datetime", nullable=true, options={"comment"="预约时间段开始时间"})
     */
    private $startTime;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="end_time", type="datetime", nullable=true, options={"comment"="预约时间段结束时间"})
     */
    private $endTime;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="state", type="integer", nullable=true, options={"comment"="预约状态，1表示正在审核，2表示预约被拒绝，3表示预约通过，4表示正在使用，5表示正常结束，6表示强制收回，7表示取消预约，8表示待评价"})
     */
    private $state;

    /**
     * @var string|null
     *
     * @ORM\Column(name="reason", type="string", length=1023, nullable=true)
     */
    private $reason;

    /**
     * @var string|null
     *
     * @ORM\Column(name="feedback", type="string", length=100, nullable=true)
     */
    private $feedback;

    /**
     * @var int|null
     *
     * @ORM\Column(name="comment_id", type="bigint", nullable=true, options={"unsigned"=true})
     */
    private $commentId;

    /**
     * @var string|null
     *
     * @ORM\Column(name="serial_number", type="string", length=18, nullable=true, options={"fixed"=true,"comment"="预约记录序列号，格式为'预约日期-预约类型-当日第几条预约'，如'20180720-01-000001'"})
     */
    private $serialNumber;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="need_sign", type="boolean", nullable=true)
     */
    private $needSign;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="gmt_create", type="datetime", nullable=true, options={"default"="CURRENT_TIMESTAMP"})
     */
    private $gmtCreate = 'CURRENT_TIMESTAMP';

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="gmt_modified", type="datetime", nullable=true, options={"default"="CURRENT_TIMESTAMP"})
     */
    private $gmtModified = 'CURRENT_TIMESTAMP';

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUserId(): ?int
    {
        return $this->userId;
    }

    public function setUserId(?int $userId): self
    {
        $this->userId = $userId;

        return $this;
    }

    public function getResourceId(): ?int
    {
        return $this->resourceId;
    }

    public function setResourceId(?int $resourceId): self
    {
        $this->resourceId = $resourceId;

        return $this;
    }

    public function getResourceType(): ?int
    {
        return $this->resourceType;
    }

    public function setResourceType(?int $resourceType): self
    {
        $this->resourceType = $resourceType;

        return $this;
    }

    public function getStartTime(): ?\DateTimeInterface
    {
        return $this->startTime;
    }

    public function setStartTime(?\DateTimeInterface $startTime): self
    {
        $this->startTime = $startTime;

        return $this;
    }

    public function getEndTime(): ?\DateTimeInterface
    {
        return $this->endTime;
    }

    public function setEndTime(?\DateTimeInterface $endTime): self
    {
        $this->endTime = $endTime;

        return $this;
    }

    public function getState(): ?int
    {
        return $this->state;
    }

    public function setState(?int $state): self
    {
        $this->state = $state;

        return $this;
    }

    public function getReason(): ?string
    {
        return $this->reason;
    }

    public function setReason(?string $reason): self
    {
        $this->reason = $reason;

        return $this;
    }

    public function getFeedback(): ?string
    {
        return $this->feedback;
    }

    public function setFeedback(?string $feedback): self
    {
        $this->feedback = $feedback;

        return $this;
    }

    public function getCommentId(): ?int
    {
        return $this->commentId;
    }

    public function setCommentId(?int $commentId): self
    {
        $this->commentId = $commentId;

        return $this;
    }

    public function getSerialNumber(): ?string
    {
        return $this->serialNumber;
    }

    public function setSerialNumber(?string $serialNumber): self
    {
        $this->serialNumber = $serialNumber;

        return $this;
    }

    public function getNeedSign(): ?bool
    {
        return $this->needSign;
    }

    public function setNeedSign(?bool $needSign): self
    {
        $this->needSign = $needSign;

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

    public function getGmtModified(): ?\DateTimeInterface
    {
        return $this->gmtModified;
    }

    public function setGmtModified(?\DateTimeInterface $gmtModified): self
    {
        $this->gmtModified = $gmtModified;

        return $this;
    }


}
