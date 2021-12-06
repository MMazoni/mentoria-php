<?php

namespace App\Application\Controller;

use Symfony\Component\HttpFoundation\{JsonResponse, Request, Response};
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class PetController extends AbstractController
{
    #[Route('/pet', name: 'create_pet', methods: ['POST'])]
    public function createPet(Request $request): JsonResponse
    {
        $payload = json_decode($request->getContent(), false);
        return new JsonResponse(['name' => $payload->name], Response::HTTP_OK);
    }
}