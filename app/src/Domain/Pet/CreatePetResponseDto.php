<?php

namespace App\Domain\Pet;

use App\Domain\ContactNumber;

class CreatePetResponseDto
{
    public function __construct(
        public int $id,
        public string $name,
        public string $animal,
        public string $contactNumber
    ) {}
}