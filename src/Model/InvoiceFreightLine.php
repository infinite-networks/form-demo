<?php

namespace App\Model;

use Symfony\Component\Validator\Constraints as Assert;

class InvoiceFreightLine extends AbstractInvoiceLine
{
    #[Assert\NotBlank]
    protected string $courier = '';

    #[Assert\NotBlank]
    protected float $unitPrice = 0;

    public function getCourier(): ?string
    {
        return $this->courier;
    }

    public function getDescription(): string
    {
        return 'Shipping: ' . $this->courier;
    }

    public function getQuantity(): float
    {
        return 1;
    }

    public function getUnitPrice(): float
    {
        return $this->unitPrice;
    }

    public function setCourier(?string $courier = '')
    {
        $this->courier = $courier ?? '';
    }

    public function setUnitPrice(float $unitPrice): void
    {
        $this->unitPrice = $unitPrice;
    }
}
