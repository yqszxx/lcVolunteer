<?php

namespace App\Entity\Appointment;

use Doctrine\ORM\Mapping as ORM;

/**
 * Authorities
 *
 * @ORM\Table(name="authorities")
 * @ORM\Entity
 */
class Authorities
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
     * @ORM\Column(name="admin_id", type="bigint", nullable=false)
     */
    private $adminId;

    /**
     * @var string
     *
     * @ORM\Column(name="authority", type="string", length=255, nullable=false)
     */
    private $authority;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAdminId(): ?int
    {
        return $this->adminId;
    }

    public function setAdminId(int $adminId): self
    {
        $this->adminId = $adminId;

        return $this;
    }

    public function getAuthority(): ?string
    {
        return $this->authority;
    }

    public function setAuthority(string $authority): self
    {
        $this->authority = $authority;

        return $this;
    }


}
