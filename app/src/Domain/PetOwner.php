<?php

namespace App\Domain;

class PetOwner
{
    public function __construct(
        private string $name,
        private ?ContactNumber $contactNumber
    ) {}

    public function name(): string
    {
        return $this->name;
    }

    public function contactNumber(): string
    {
        return (string) $this->contactNumber;
    }

    public function __toString(): string
    {
        return $this->name;
    }
}