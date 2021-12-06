<?php

namespace App\Domain\Pet;

use App\Application\Pet\CreatePetRequestDto;
use App\Domain\ContactNumber;
use Doctrine\ORM\Mapping\{Entity, Id, Column, GeneratedValue};

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
        private Animal $animal,
        #[Column(type: "string")]
        private Breed $breed,
        #[Column(type: "string")]
        private ContactNumber $contactNumber
    )
    {}

    public static function fromDto(
        CreatePetRequestDto $createPetRequestDto
    ): Pet
    {
        return new Pet(
            $createPetRequestDto->name,
            $createPetRequestDto->age,
            $createPetRequestDto->animal,
            $createPetRequestDto->breed,
            $createPetRequestDto->contactNumber
        );
    }

    public function toDto()
    {
        return new CreatePetResponseDto(
            $this->id,
            $this->name,
            $this->animal,
            $this->contactNumber
        );
    }
}