<?php

namespace App\Model;

abstract class AbstractInvoiceLine
{
    public abstract function getDescription(): string;
    public abstract function getQuantity(): float;
    public function getTotalPrice(): float
    {
        return $this->getQuantity() * $this->getUnitPrice();
    }
    public abstract function getUnitPrice(): float;
}
