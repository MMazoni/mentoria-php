<?php

namespace App\Application\Pet;

class CreatePetResponseDto
{
    public function __construct(
        protected int $id,
        protected string $name,
        protected string $animal,
        protected string $ownerName,
        protected string $contactNumber
    ) {}

    public function toArray(): array
    {
        return [
            "id" => $this->id,
            "name" => $this->name,
            "animal" => $this->animal,
            "owner_name" => $this->ownerName,
            "contact_number" => $this->contactNumber
        ];
    }
}