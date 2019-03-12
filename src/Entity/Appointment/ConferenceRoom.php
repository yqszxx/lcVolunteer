<?php

namespace App\Entity\Appointment;

use Doctrine\ORM\Mapping as ORM;

/**
 * ConferenceRoom
 *
 * @ORM\Table(name="conference_room")
 * @ORM\Entity(repositoryClass="App\Repository\Appointment\ConferenceRoomRepository")
 */
class ConferenceRoom
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
     * @ORM\Column(name="parent_id", type="bigint", nullable=true, options={"unsigned"=true})
     */
    private $parentId;

    /**
     * @var int|null
     *
     * @ORM\Column(name="strategy_id", type="bigint", nullable=true, options={"unsigned"=true})
     */
    private $strategyId;

    /**
     * @var string|null
     *
     * @ORM\Column(name="name", type="string", length=20, nullable=true)
     */
    private $name;

    /**
     * @var string|null
     *
     * @ORM\Column(name="description", type="string", length=200, nullable=true)
     */
    private $description;

    /**
     * @var int|null
     *
     * @ORM\Column(name="capacity", type="integer", nullable=true, options={"unsigned"=true})
     */
    private $capacity;

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

    public function getParentId(): ?int
    {
        return $this->parentId;
    }

    public function setParentId(?int $parentId): self
    {
        $this->parentId = $parentId;

        return $this;
    }

    public function getStrategyId(): ?int
    {
        return $this->strategyId;
    }

    public function setStrategyId(?int $strategyId): self
    {
        $this->strategyId = $strategyId;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getCapacity(): ?int
    {
        return $this->capacity;
    }

    public function setCapacity(?int $capacity): self
    {
        $this->capacity = $capacity;

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
