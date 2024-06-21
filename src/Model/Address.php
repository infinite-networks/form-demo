<?php

namespace App\Model;

use Symfony\Component\Validator\Constraints as Assert;

class Address
{
    #[Assert\NotBlank]
    public ?string $line1 = null;

    public ?string $line2 = null;

    public ?string $line3 = null;

    #[Assert\NotBlank]
    public ?string $postcode = null;
}
