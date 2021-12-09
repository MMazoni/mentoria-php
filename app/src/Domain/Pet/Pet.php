<?php

namespace App\Domain\Pet;

use App\Application\Pet\CreatePetRequestDto;
use App\Application\Pet\CreatePetResponseDto;
use App\Application\Pet\UpdatePetRequestDto;
use App\Domain\PetOwner;
use Doctrine\ORM\Mapping\{Entity, Id, Column, GeneratedValue};
use JetBrains\PhpStorm\Pure;

#[Entity(repositoryClass: PetRepository::class)]
class Pet
{
    #[Id]
    #[Column(type: "integer")]
    #[GeneratedValue]
    private int $id;

    public function __construct(
        #[Column(type: "string")]
        private string $name,
        #[Column(type: "integer")]
        private int $age,
        #[Column(type: "string")]
        private Animal|string $animal,
        #[Column(type: "string")]
        private Breed|string $breed,
        #[Column(type: "string")]
        private PetOwner|string $owner
    )
    {}

    #[Pure]
    public static function fromDto(
        CreatePetRequestDto $createPetRequestDto
    ): Pet
    {
        return new Pet(
            $createPetRequestDto->name,
            $createPetRequestDto->age,
            $createPetRequestDto->animal,
            $createPetRequestDto->breed,
            $createPetRequestDto->owner
        );
    }

    #[Pure]
    public function toDto(): CreatePetResponseDto
    {
        return new CreatePetResponseDto(
            $this->id,
            $this->name,
            $this->animal,
            $this->owner->name(),
            $this->owner->contactNumber()
        );
    }

	public function toArray(): array
	{
		return [
			'id' => $this->id,
			'name' => $this->name,
			'age' => $this->age,
			'animal' => (string) $this->animal,
			'breed' => (string) $this->breed,
			'owner_name' => (string) $this->owner,
		];
	}

	public function updateValues(UpdatePetRequestDto $updatePetRequestDto)
	{
		$this->name = $updatePetRequestDto->name;
		$this->age = $updatePetRequestDto->age;
		$this->animal = $updatePetRequestDto->animal;
		$this->breed = $updatePetRequestDto->breed;
		$this->owner = $updatePetRequestDto->ownerName;
	}
}
