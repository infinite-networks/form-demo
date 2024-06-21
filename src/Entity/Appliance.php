<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity]
class Appliance
{
    #[ORM\Column(type: 'integer')]
    #[ORM\GeneratedValue]
    #[ORM\Id]
    protected ?int $id = null;

    #[Assert\NotBlank]
    #[ORM\Column(type: 'string', length: 200)]
    protected string $name = '';

    #[ORM\OneToOne(targetEntity: ApplianceManual::class, cascade: ['persist'], orphanRemoval: true)]
    protected ?ApplianceManual $manual = null;

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

    public function getManual(): ?ApplianceManual
    {
        return $this->manual;
    }

    public function setManual(?ApplianceManual $manual): void
    {
        $this->manual = $manual;
    }
}
