<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * An employee who works in sales.
 */
#[ORM\Entity]
class Salesman
{
    #[ORM\Column(type: 'integer')]
    #[ORM\GeneratedValue]
    #[ORM\Id]
    protected ?int $id = null;

    #[Assert\NotBlank]
    #[ORM\Column(type: 'string', length: 50)]
    protected string $name = '';

    #[ORM\OneToMany(targetEntity: SalesmanProductArea::class, mappedBy: 'salesman', cascade: ['all'], orphanRemoval: true)]
    /**
     * @var Collection|SalesmanProductArea[]
     */
    protected Collection $productAreas;

    public function __construct()
    {
        $this->productAreas = new ArrayCollection;
    }

    public function addProductArea(SalesmanProductArea $productArea): void
    {
        $this->productAreas->add($productArea);
        $productArea->setSalesman($this);
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

	/***
	 * @return Collection|SalesmanProductArea[]
	 */
    public function getProductAreas(): Collection|array
    {
        return $this->productAreas;
    }

    public function removeProductArea(SalesmanProductArea $productArea): void
    {
        $this->productAreas->removeElement($productArea);
    }

    public function setName(?string $name): void
    {
        $this->name = $name ?? '';
    }
}
