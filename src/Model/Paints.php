<?php

namespace App\Model;

use Symfony\Component\Validator\Constraints as Assert;

class Paints
{
	#[Assert\Count(min: 1)]
    public array $paints = [];
}
