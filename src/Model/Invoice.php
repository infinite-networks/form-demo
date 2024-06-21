<?php

namespace App\Model;

use Symfony\Component\Validator\Constraints as Assert;

class Invoice
{
    /**
     * @var AbstractInvoiceLine[]
     */
    #[Assert\Valid]
    #[Assert\Count(min: 1)]
    public array $lines = [];

    #[Assert\NotBlank]
    public ?string $recipient = null;

    public function getTotal(): float
    {
        $total = 0;

        foreach ($this->lines as $line) {
            $total += $line->getTotalPrice();
        }

        return $total;
    }
}
