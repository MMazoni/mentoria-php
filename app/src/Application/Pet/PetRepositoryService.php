<?php

namespace App\Application\Pet;

use App\Domain\Pet\Pet;
use App\Domain\Pet\PetRepositoryInterface;

class PetRepositoryService
{
    public function __construct(public PetRepositoryInterface $petRepository)
    {}

    public function createPet(CreatePetRequestDto $createPetRequestDto): CreatePetResponseDto
    {
        $pet = Pet::fromDto($createPetRequestDto);
        $this->petRepository->addPet($pet);
        return $pet->toDto();
    }
}