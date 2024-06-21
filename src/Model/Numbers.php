<?php

namespace App\Model;

use Symfony\Component\Validator\Constraints as Assert;

class Numbers
{
    /**
     * @var int[]
     */
    #[Assert\Count(min: 1)]
    public array $numbers = [];
}
