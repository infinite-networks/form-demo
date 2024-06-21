<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * An area in which a salesman can operate.
 */
#[ORM\Entity]
class Area
{
    #[ORM\Column(type: 'integer')]
    #[ORM\GeneratedValue]
    #[ORM\Id]
    protected ?int $id = null;

    #[ORM\Column(type: 'string', length: 50)]
    protected string $name = '';

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(?string $name): void
    {
        $this->name = $name ?? '';
    }

    public function __toString(): string
    {
        return $this->name;
    }
}
