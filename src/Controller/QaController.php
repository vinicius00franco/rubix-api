<?php

// src/Controller/QaController.php

namespace App\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\QaService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class QaController extends AbstractController
{
    private QaService $qaService;

    public function __construct(QaService $qaService)
    {
        $this->qaService = $qaService;
    }

    #[Route('/api/qa', name: 'api_qa', methods: ['POST'])]
    public function getAnswer(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $question = $data['question'] ?? null;

        if (!$question) {
            return $this->json(['error' => 'Pergunta não fornecida.'], 400);
        }

        $answer = $this->qaService->getAnswer($question);

        if ($answer === null) {
            return $this->json(['error' => 'Não foi possível encontrar uma resposta.'], 404);
        }

        return $this->json(['answer' => $answer]);
    }
}
