<?php

namespace App\Model;

use Symfony\Component\Validator\Constraints as Assert;

class Customer
{
    /**
     * @var Address[]
     */
    #[Assert\Valid]
    #[Assert\Count(min: 1)]
    public array $addresses = [];

    #[Assert\NotBlank]
    public ?string $name = null;
}
