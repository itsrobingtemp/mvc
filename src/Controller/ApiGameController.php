<?php

namespace App\Controller;

use App\Card\TwentyOne;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class ApiGameController extends AbstractController
{
    #[Route('/api/game', name: 'apiGame')]
    public function apiGame(SessionInterface $session): Response
    {
        $currentGame = $session->get("current_game");

        if (!is_array($currentGame)) {
            $currentGame = [];
        }

        $twentyOne = new TwentyOne($currentGame);
        $gameData = $twentyOne->getCurrentGame();

        $data = [
            'playerScore' => $gameData["playerScore"],
            'computerScore' => $gameData["computerScore"],
            'card' => $gameData["currentCard"],
            'finishedRound' => $gameData["finishedRound"],
            'resultString' => $gameData["resultString"]
        ];

        $response = new JsonResponse($data);

        $response->setEncodingOptions(
            $response->getEncodingOptions() | JSON_PRETTY_PRINT
        );

        return $response;
    }
}
