<?php

// src/Controller/HealthController.php

namespace App\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\HealthService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\Validator\Constraints as Assert;

class HealthController extends AbstractController
{
    private HealthService $healthService;
    private ValidatorInterface $validator;

    public function __construct(HealthService $healthService, ValidatorInterface $validator)
    {
        $this->healthService = $healthService;
        $this->validator = $validator;
    }

    #[Route('/api/evaluate-health', name: 'api_evaluate_health', methods: ['POST'])]
    public function evaluateHealth(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        // Definir restrições de validação
        $constraints = new Assert\Collection([
            'idade' => [new Assert\NotBlank(), new Assert\Type('integer'), new Assert\Range(['min' => 0, 'max' => 120])],
            'sexo' => [new Assert\NotBlank(), new Assert\Choice(['choices' => ['Masculino', 'Feminino']])],
            'peso' => [new Assert\NotBlank(), new Assert\Type(['type' => 'numeric', 'message' => 'O peso deve ser um número.'])],
            'habito1' => [new Assert\Optional([new Assert\Type('integer'), new Assert\Choice([0, 1])])],
            'habito2' => [new Assert\Optional([new Assert\Type('integer'), new Assert\Choice([0, 1])])],
        ]);

        $violations = $this->validator->validate($data, $constraints);

        if (count($violations) > 0) {
            $errors = [];

            foreach ($violations as $violation) {
                $errors[] = $violation->getPropertyPath() . ': ' . $violation->getMessage();
            }

            return $this->json(['errors' => $errors], 400);
        }

        // Extrair os dados necessários
        $features = [
            $data['idade'],
            $data['sexo'],
            $data['peso'],
            $data['habito1'] ?? 0,
            $data['habito2'] ?? 0,
        ];

        $assessment = $this->healthService->evaluate($features);

        if ($assessment === null) {
            return $this->json(['error' => 'Não foi possível avaliar a saúde.'], 500);
        }

        return $this->json(['assessment' => $assessment]);
    }
}
