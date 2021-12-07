<?php

namespace App\Application\Pet;

use App\Domain\ContactNumber;
use App\Domain\Pet\Animal;
use App\Domain\Pet\Breed;
use App\Domain\PetOwner;

class CreatePetRequestDto
{
    public Animal $animal;
    public Breed $breed;
    public ContactNumber $contactNumber;
    public PetOwner $owner;

    public function __construct(
        public string $name,
        public int $age,
        public string $animalType,
        public string $breedName,
        public string $ownerName,
        public string $ddd,
        public string $number
    ) {
        $this->animal = new Animal($animalType);
        $this->breed = new Breed($breedName);
        $contactNumber = new ContactNumber($ddd, $number);
        $this->owner = new PetOwner($ownerName, $contactNumber);
    }
}