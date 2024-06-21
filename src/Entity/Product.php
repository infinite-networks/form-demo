<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * A product that we sell.
 */
#[ORM\Entity]
class Product
{
    #[ORM\Column(type: 'integer')]
    #[ORM\GeneratedValue]
    #[ORM\Id]
    protected ?int $id = null;

    #[ORM\Column(type: 'decimal', precision: 10, scale: 2)]
    protected float $cost = 0;

    #[ORM\Column(type: 'string', length: 50)]
    protected string $name = '';

    #[ORM\Column(type: 'decimal', precision: 10, scale: 2)]
    protected float $sellPrice = 0;

    public function getCost(): float
    {
        return $this->cost;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getSellPrice(): float
    {
        return $this->sellPrice;
    }

    public function setCost(float $cost): void
    {
        $this->cost = $cost;
    }

    public function setName(?string $name): void
    {
        $this->name = $name ?? '';
    }

    public function setSellPrice(float $sellPrice): void
    {
        $this->sellPrice = $sellPrice;
    }

    public function __toString(): string
    {
        return $this->name;
    }
}
