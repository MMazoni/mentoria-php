<?php

namespace App\Domain\Pet;

use App\Domain\PetOwner;

class Pet
{

    public function __construct(
        private string $name,
        private int $age,
        private Animal|string $animal,
        private Breed|string $breed,
        private PetOwner|string $owner
    )
    {}

}
