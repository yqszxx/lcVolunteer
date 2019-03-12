<?php

namespace App\Entity\Appointment;

use Doctrine\ORM\Mapping as ORM;

/**
 * Seat
 *
 * @ORM\Table(name="seat")
 * @ORM\Entity
 */
class Seat
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
     * @ORM\Column(name="x", type="integer", nullable=false)
     */
    private $x;

    /**
     * @var int
     *
     * @ORM\Column(name="y", type="integer", nullable=false)
     */
    private $y;

    /**
     * @var string|null
     *
     * @ORM\Column(name="number", type="string", length=255, nullable=true)
     */
    private $number;

    /**
     * @var int
     *
     * @ORM\Column(name="parent_id", type="bigint", nullable=false)
     */
    private $parentId;

    /**
     * @var int|null
     *
     * @ORM\Column(name="guard", type="bigint", nullable=true)
     */
    private $guard;

    /**
     * @var string|null
     *
     * @ORM\Column(name="pre_guard", type="string", length=255, nullable=true)
     */
    private $preGuard;

    /**
     * @var int
     *
     * @ORM\Column(name="strategy_id", type="integer", nullable=false)
     */
    private $strategyId;

    /**
     * @var bool
     *
     * @ORM\Column(name="is_deleted", type="boolean", nullable=false)
     */
    private $isDeleted = '0';

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="create_time", type="datetime", nullable=true, options={"default"="CURRENT_TIMESTAMP"})
     */
    private $createTime = 'CURRENT_TIMESTAMP';

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="modified_time", type="datetime", nullable=true, options={"default"="CURRENT_TIMESTAMP"})
     */
    private $modifiedTime = 'CURRENT_TIMESTAMP';

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getX(): ?int
    {
        return $this->x;
    }

    public function setX(int $x): self
    {
        $this->x = $x;

        return $this;
    }

    public function getY(): ?int
    {
        return $this->y;
    }

    public function setY(int $y): self
    {
        $this->y = $y;

        return $this;
    }

    public function getNumber(): ?string
    {
        return $this->number;
    }

    public function setNumber(?string $number): self
    {
        $this->number = $number;

        return $this;
    }

    public function getParentId(): ?int
    {
        return $this->parentId;
    }

    public function setParentId(int $parentId): self
    {
        $this->parentId = $parentId;

        return $this;
    }

    public function getGuard(): ?int
    {
        return $this->guard;
    }

    public function setGuard(?int $guard): self
    {
        $this->guard = $guard;

        return $this;
    }

    public function getPreGuard(): ?string
    {
        return $this->preGuard;
    }

    public function setPreGuard(?string $preGuard): self
    {
        $this->preGuard = $preGuard;

        return $this;
    }

    public function getStrategyId(): ?int
    {
        return $this->strategyId;
    }

    public function setStrategyId(int $strategyId): self
    {
        $this->strategyId = $strategyId;

        return $this;
    }

    public function getIsDeleted(): ?bool
    {
        return $this->isDeleted;
    }

    public function setIsDeleted(bool $isDeleted): self
    {
        $this->isDeleted = $isDeleted;

        return $this;
    }

    public function getCreateTime(): ?\DateTimeInterface
    {
        return $this->createTime;
    }

    public function setCreateTime(?\DateTimeInterface $createTime): self
    {
        $this->createTime = $createTime;

        return $this;
    }

    public function getModifiedTime(): ?\DateTimeInterface
    {
        return $this->modifiedTime;
    }

    public function setModifiedTime(?\DateTimeInterface $modifiedTime): self
    {
        $this->modifiedTime = $modifiedTime;

        return $this;
    }


}
