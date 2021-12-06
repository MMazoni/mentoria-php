<?php

namespace App\Application\Pet;

use App\Domain\Pet\CreatePetResponseDto;
use App\Domain\Pet\Pet;
use App\Domain\Pet\PetRepository;

class PetRepositoryService
{
    public function __construct(public PetRepository $petRepository)
    {}

    public function createPet(CreatePetRequestDto $createPetRequestDto): CreatePetResponseDto
    {
        $pet = Pet::fromDto($createPetRequestDto);
        $this->petRepository->addPet($pet);
        return $pet->toDto();
    }
}