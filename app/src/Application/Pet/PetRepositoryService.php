<?php

namespace App\Application\Pet;

use App\Infrastructure\Entity\Pet;
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

	public function retrievePets(): array
	{
		return $this->petRepository->findAll();
	}

	public function retrieveOnePet(int $id): Pet
	{
		return $this->petRepository->find($id);
	}

	public function deletePet(Pet $pet)
	{
		$this->petRepository->removePet($pet);
	}

	public function updatePet(int $id, UpdatePetRequestDto $updatePetRequestDto): array
	{
		$pet = $this->retrieveOnePet($id);
		if (empty($pet)) {
			return [];
		}
		$pet->updateValues($updatePetRequestDto);
		$this->petRepository->addPet($pet);
		return $pet->toArray();
	}
}