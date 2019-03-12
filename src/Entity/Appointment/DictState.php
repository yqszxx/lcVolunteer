<?php

namespace App\Entity\Appointment;

use Doctrine\ORM\Mapping as ORM;

/**
 * DictState
 *
 * @ORM\Table(name="dict_state")
 * @ORM\Entity(repositoryClass="App\Repository\Appointment\DictStateRepository")
 */
class DictState
{
    /**
     * @var int
     *
     * @ORM\Column(name="value", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $value;

    /**
     * @var string|null
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=true)
     */
    private $name;

    public function getValue(): ?int
    {
        return $this->value;
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


}
