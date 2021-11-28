<?php

namespace App\Domain\Pet;

class Animal
{
    public function __construct(
        private string $type
    )
    {}

    public function __toString(): string
    {
        return $this->type;
    }
}