<?php

namespace App\Entity\Appointment;

use Doctrine\ORM\Mapping as ORM;

/**
 * User
 *
 * @ORM\Table(name="user", uniqueConstraints={@ORM\UniqueConstraint(name="uk_user_openid", columns={"openid"}), @ORM\UniqueConstraint(name="uk_user_auth_id", columns={"auth_id"}), @ORM\UniqueConstraint(name="uk_user_unionid", columns={"unionid"})})
 * @ORM\Entity
 */
class User
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
     * @var string
     *
     * @ORM\Column(name="auth_id", type="string", length=20, nullable=false)
     */
    private $authId;

    /**
     * @var string
     *
     * @ORM\Column(name="real_name", type="string", length=50, nullable=false)
     */
    private $realName;

    /**
     * @var string|null
     *
     * @ORM\Column(name="openid", type="string", length=255, nullable=true)
     */
    private $openid;

    /**
     * @var string|null
     *
     * @ORM\Column(name="unionid", type="string", length=255, nullable=true)
     */
    private $unionid;

    /**
     * @var bool
     *
     * @ORM\Column(name="is_staff", type="boolean", nullable=false)
     */
    private $isStaff;

    /**
     * @var int
     *
     * @ORM\Column(name="credits", type="integer", nullable=false)
     */
    private $credits;

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

    public function getAuthId(): ?string
    {
        return $this->authId;
    }

    public function setAuthId(string $authId): self
    {
        $this->authId = $authId;

        return $this;
    }

    public function getRealName(): ?string
    {
        return $this->realName;
    }

    public function setRealName(string $realName): self
    {
        $this->realName = $realName;

        return $this;
    }

    public function getOpenid(): ?string
    {
        return $this->openid;
    }

    public function setOpenid(?string $openid): self
    {
        $this->openid = $openid;

        return $this;
    }

    public function getUnionid(): ?string
    {
        return $this->unionid;
    }

    public function setUnionid(?string $unionid): self
    {
        $this->unionid = $unionid;

        return $this;
    }

    public function getIsStaff(): ?bool
    {
        return $this->isStaff;
    }

    public function setIsStaff(bool $isStaff): self
    {
        $this->isStaff = $isStaff;

        return $this;
    }

    public function getCredits(): ?int
    {
        return $this->credits;
    }

    public function setCredits(int $credits): self
    {
        $this->credits = $credits;

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
