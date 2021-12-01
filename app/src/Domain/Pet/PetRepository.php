<?php

namespace App\Domain\Pet;

interface PetRepository
{
    public function addPet(Pet $pet): void;
    public function find(string|int $id): Pet;
}