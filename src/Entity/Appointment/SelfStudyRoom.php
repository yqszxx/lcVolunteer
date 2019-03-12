<?php

namespace App\Entity\Appointment;

use Doctrine\ORM\Mapping as ORM;

/**
 * SelfStudyRoom
 *
 * @ORM\Table(name="self_study_room")
 * @ORM\Entity
 */
class SelfStudyRoom
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var int|null
     *
     * @ORM\Column(name="parent_id", type="bigint", nullable=true)
     */
    private $parentId;

    /**
     * @var string|null
     *
     * @ORM\Column(name="name", type="string", length=20, nullable=true)
     */
    private $name;

    /**
     * @var string|null
     *
     * @ORM\Column(name="layout_image", type="string", length=255, nullable=true)
     */
    private $layoutImage;

    /**
     * @var int|null
     *
     * @ORM\Column(name="strategy_id", type="bigint", nullable=true)
     */
    private $strategyId;

    /**
     * @var int|null
     *
     * @ORM\Column(name="rows", type="integer", nullable=true, options={"unsigned"=true})
     */
    private $rows;

    /**
     * @var int|null
     *
     * @ORM\Column(name="columns", type="integer", nullable=true, options={"unsigned"=true})
     */
    private $columns;

    /**
     * @var int|null
     *
     * @ORM\Column(name="total", type="integer", nullable=true, options={"unsigned"=true})
     */
    private $total;

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

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getLayoutImage(): ?string
    {
        return $this->layoutImage;
    }

    public function setLayoutImage(?string $layoutImage): self
    {
        $this->layoutImage = $layoutImage;

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

    public function getRows(): ?int
    {
        return $this->rows;
    }

    public function setRows(?int $rows): self
    {
        $this->rows = $rows;

        return $this;
    }

    public function getColumns(): ?int
    {
        return $this->columns;
    }

    public function setColumns(?int $columns): self
    {
        $this->columns = $columns;

        return $this;
    }

    public function getTotal(): ?int
    {
        return $this->total;
    }

    public function setTotal(?int $total): self
    {
        $this->total = $total;

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
