<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * A mapping that represents that a specific salesman can sell a specific product in a specific area.
 */
#[ORM\Entity]
class SalesmanProductArea
{
    #[ORM\Column(type: 'integer')]
    #[ORM\GeneratedValue]
    #[ORM\Id]
    protected ?int $id = null;

    #[ORM\ManyToOne(targetEntity: Area::class)]
    #[ORM\JoinColumn(onDelete: 'CASCADE')]
    protected Area $areaServiced;

    #[ORM\ManyToOne(targetEntity: Product::class)]
    #[ORM\JoinColumn(onDelete: 'CASCADE')]
    protected Product $productSold;

    #[ORM\ManyToOne(targetEntity: Salesman::class, inversedBy: 'productAreas')]
    #[ORM\JoinColumn(onDelete: 'CASCADE')]
    protected Salesman $salesman;

    public function getAreaServiced(): Area
    {
        return $this->areaServiced;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProductSold(): Product
    {
        return $this->productSold;
    }

    public function getSalesman(): Salesman
    {
        return $this->salesman;
    }

    public function setAreaServiced(Area $areaServiced): void
    {
        $this->areaServiced = $areaServiced;
    }

    public function setProductSold(Product $productSold): void
    {
        $this->productSold = $productSold;
    }

    public function setSalesman(Salesman $salesman): void
    {
        $this->salesman = $salesman;
    }
}
