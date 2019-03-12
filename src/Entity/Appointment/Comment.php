<?php

namespace App\Entity\Appointment;

use Doctrine\ORM\Mapping as ORM;

/**
 * Comment
 *
 * @ORM\Table(name="comment")
 * @ORM\Entity
 */
class Comment
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
     * @var bool|null
     *
     * @ORM\Column(name="overall", type="boolean", nullable=true)
     */
    private $overall;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="environment", type="boolean", nullable=true)
     */
    private $environment;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="system", type="boolean", nullable=true)
     */
    private $system;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="equipment", type="boolean", nullable=true)
     */
    private $equipment;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="service", type="boolean", nullable=true)
     */
    private $service;

    /**
     * @var string|null
     *
     * @ORM\Column(name="content", type="string", length=200, nullable=true)
     */
    private $content;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="create_time", type="datetime", nullable=false, options={"default"="CURRENT_TIMESTAMP"})
     */
    private $createTime = 'CURRENT_TIMESTAMP';

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOverall(): ?bool
    {
        return $this->overall;
    }

    public function setOverall(?bool $overall): self
    {
        $this->overall = $overall;

        return $this;
    }

    public function getEnvironment(): ?bool
    {
        return $this->environment;
    }

    public function setEnvironment(?bool $environment): self
    {
        $this->environment = $environment;

        return $this;
    }

    public function getSystem(): ?bool
    {
        return $this->system;
    }

    public function setSystem(?bool $system): self
    {
        $this->system = $system;

        return $this;
    }

    public function getEquipment(): ?bool
    {
        return $this->equipment;
    }

    public function setEquipment(?bool $equipment): self
    {
        $this->equipment = $equipment;

        return $this;
    }

    public function getService(): ?bool
    {
        return $this->service;
    }

    public function setService(?bool $service): self
    {
        $this->service = $service;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(?string $content): self
    {
        $this->content = $content;

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


}
