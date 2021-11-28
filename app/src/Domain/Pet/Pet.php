<?php

namespace App\Domain\Pet;

use App\Domain\ContactNumber;

class Pet
{
    public function __construct(
        private string $name,
        private int $age,
        private Animal $animal,
        private Breed $breed,
        private ContactNumber $contactNumber
    )
    {}
}