<?php

namespace App\Application\Pet;

use App\Domain\ContactNumber;
use App\Domain\Pet\Animal;
use App\Domain\Pet\Breed;

class CreatePetRequestDto
{
    public Animal $animal;
    public Breed $breed;
    public ContactNumber $contactNumber;

    public function __construct(
        public string $name,
        public int $age,
        public string $animalType,
        public string $breedName,
        public string $ddd,
        public string $number
    ) {
        $this->animal = new Animal($animalType);
        $this->breed = new Breed($breedName);
        $this->contactNumber = new ContactNumber($ddd, $number);
    }
}