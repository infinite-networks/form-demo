<?php

namespace App\Model;

use Symfony\Component\Validator\Constraints as Assert;

class InvoiceServiceLine extends AbstractInvoiceLine
{
    #[Assert\NotBlank]
    protected string $description = '';

    #[Assert\NotBlank]
    protected float $quantity = 0;

    #[Assert\NotBlank]
    protected float $unitPrice = 0;

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getQuantity(): float
    {
        return $this->quantity;
    }

    public function getUnitPrice(): float
    {
        return $this->unitPrice;
    }

    public function setDescription(?string $description): void
    {
        $this->description = $description ?? '';
    }

    public function setQuantity(float $quantity): void
    {
        $this->quantity = $quantity;
    }

    public function setUnitPrice(float $unitPrice): void
    {
        $this->unitPrice = $unitPrice;
    }
}
