<?php

namespace App\Domain\Pet;

interface PetRepositoryInterface
{
    public function addPet(Pet $pet): void;
    public function find(string|int $id): Pet;
	public function findAll(): array;
	public function removePet(Pet $pet): void;
}