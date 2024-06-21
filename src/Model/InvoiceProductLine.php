<?php

namespace App\Model;

use Symfony\Component\Validator\Constraints as Assert;

class InvoiceProductLine extends AbstractInvoiceLine
{
    #[Assert\NotBlank]
    protected string $productName = '';

    #[Assert\NotBlank]
    protected float $quantity = 0;

    #[Assert\NotBlank]
    protected float $unitPrice = 0;

    public function getDescription(): string
    {
        return $this->productName;
    }

    public function getUnitPrice(): float
    {
        return $this->unitPrice;
    }

    public function setUnitPrice(float $unitPrice): void
    {
        $this->unitPrice = $unitPrice;
    }

    public function getQuantity(): float
    {
        return $this->quantity;
    }

    public function setQuantity(float $quantity): void
    {
        $this->quantity = $quantity;
    }

    public function getProductName(): string
    {
        return $this->productName;
    }

    public function setProductName(?string $productName): void
    {
        $this->productName = $productName ?? '';
    }
}
