<?php

namespace App\Domain\Pet;

use App\Application\Pet\CreatePetRequestDto;
use App\Application\Pet\CreatePetResponseDto;
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

	public function getId(): int
	{
		return $this->id;
	}


	public function getName(): string
	{
		return $this->name;
	}

	public function getAge(): int
	{
		return $this->age;
	}

	public function getAnimal(): string|Animal
	{
		return $this->animal;
	}

	public function getBreed(): string|Breed
	{
		return $this->breed;
	}

	public function getOwner(): PetOwner|string
	{
		return $this->owner;
	}

}