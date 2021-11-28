<?php

namespace App\Domain\Pet;

class Breed
{
    public function __construct(
        private string $name
    )
    {}

    public function __toString(): string
    {
        return $this->name;
    }

}