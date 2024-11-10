<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\QaService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\Validator\Constraints as Assert;

class QaController extends AbstractController
{
    private QaService $qaService;
    private ValidatorInterface $validator;

    public function __construct(QaService $qaService, ValidatorInterface $validator)
    {
        $this->qaService = $qaService;
        $this->validator = $validator;
    }

    #[Route('/api/qa', name: 'api_qa', methods: ['POST'])]
    public function getAnswer(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $question = $data['question'] ?? null;

        // Validação da pergunta
        $constraints = new Assert\Collection([
            'question' => [
                new Assert\NotBlank(['message' => 'Pergunta não fornecida.']),
                new Assert\Type(['type' => 'string', 'message' => 'A pergunta deve ser uma string.'])
            ],
        ]);

        $violations = $this->validator->validate($data, $constraints);

        if (count($violations) > 0) {
            $errors = [];

            foreach ($violations as $violation) {
                $errors[] = $violation->getPropertyPath() . ': ' . $violation->getMessage();
            }

            return $this->json(['errors' => $errors], 400);
        }

        $answer = $this->qaService->getAnswer($question);

        if ($answer === null) {
            return $this->json(['error' => 'Não foi possível encontrar uma resposta.'], 404);
        }

        return $this->json(['answer' => $answer]);
    }
}
