<?php

namespace App\Infrastructure\Pet;

use App\Domain\Pet\Pet;
use App\Domain\Pet\PetRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;

class PetRepositoryDoctrine implements PetRepository
{
    private EntityRepository $petRepository;

    public function __construct(
        private EntityManager $entityManager
    )
    {
        $this->petRepository = $this->entityManager->getRepository(Pet::class);
    }

    /**
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws \Doctrine\ORM\ORMException
     */
    public function addPet(Pet $pet): void
    {
        $this->entityManager->persist($pet);
        $this->entityManager->flush();
    }

    public function find(string|int $id): Pet
    {
        return $this->petRepository->find($id);
    }
}