<?php

namespace App\Application\Controller;

use App\Application\Pet\CreatePetRequestDto;
use App\Application\Pet\PetRepositoryService;
use App\Application\Pet\UpdatePetRequestDto;
use Symfony\Component\HttpFoundation\{JsonResponse, Request, Response};
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class PetController extends AbstractController
{

    public function __construct(
        public PetRepositoryService $petRepositoryService
    )
    {}

    #[Route('/pet', name: 'create_pet', methods: ['POST'])]
		public function createPet(Request $request): JsonResponse
    {
        $payload = json_decode($request->getContent(), false);
        $createPetRequestDto = new CreatePetRequestDto(
            $payload->name,
            $payload->age,
            $payload->animal_type,
            $payload->breed,
            $payload->owner_name,
            $payload->owner_ddd,
            $payload->owner_phone_number
        );
        $petDto = $this->petRepositoryService->createPet($createPetRequestDto);

        if (empty($response)) {
            return new JsonResponse([
                'message' => 'Pet couldn\'t be add to database.',
                'code' => Response::HTTP_INTERNAL_SERVER_ERROR
            ]);
        }
        $responseData = array_merge(
            ['message' => 'Pet created successfully.'],
			['data' => $petDto->toArray()]
        );

        return new JsonResponse($responseData, Response::HTTP_CREATED);
    }

	#[Route('/pet', name: 'retrieve_pets', methods: ['GET'])]
	public function retrievePets(): JsonResponse
	{
		$pets = $this->petRepositoryService->retrievePets();

		if (empty($pets)) {
			return new JsonResponse([], Response::HTTP_NO_CONTENT);
		}

		$data = [];
		foreach ($pets as $pet) {
			$data[] = $pet->toArray();
		}
		return new JsonResponse($data, Response::HTTP_OK);
	}

	#[Route('/pet/{id}', name: 'retrieve_one_pet', methods: ['GET'])]
	public function retrieveOnePet(int $id): JsonResponse
	{
		$pet = $this->petRepositoryService->retrieveOnePet($id);

		if (empty($pet)) {
			return new JsonResponse(
				['message' => 'Could not find the pet.'],
				Response::HTTP_NOT_FOUND
			);
		}

		return new JsonResponse($pet->toArray(), Response::HTTP_OK);
	}

	#[Route('/pet/{id}', name: 'delete_pet', methods: ['DELETE'])]
	public function deletePet(int $id): JsonResponse
	{
		$pet = $this->petRepositoryService->retrieveOnePet($id);

		if (empty($pet)) {
			return new JsonResponse(
				['message' => 'Could not find the pet.'],
				Response::HTTP_NOT_FOUND
			);
		}

		$this->petRepositoryService->deletePet($pet);

		return new JsonResponse(
			['message' => 'Pet deleted.'],
			Response::HTTP_NO_CONTENT
		);
	}

	#[Route('/pet/{id}', name: 'update_pet', methods: ['PUT'])]
	public function updatePet(int $id, Request $request): JsonResponse
	{
		$payload = json_decode($request->getContent(), false);
		$updatePetRequestDto = new UpdatePetRequestDto(
			$payload->name,
			$payload->age,
			$payload->animal_type,
			$payload->breed,
			$payload->owner_name,
		);
		$petArray = $this->petRepositoryService->updatePet($id, $updatePetRequestDto);

		if (empty($petArray)) {
			return new JsonResponse(
				['message' => 'Could not find the pet.'],
				Response::HTTP_NOT_FOUND
			);
		}
		$responseData = array_merge(
			['message' => 'Pet updated successfully.'],
			['data' => $petArray]
		);
		return new JsonResponse($responseData, Response::HTTP_OK);
	}
}
