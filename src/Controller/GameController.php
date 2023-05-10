<?php

namespace App\Controller;
use App\Card\TwentyOne;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GameController extends AbstractController
{
    #[Route('/game', name: 'game')]
    public function game(SessionInterface $session): Response
    {
        if (empty($session->get('current_game'))) {
            $session->set('current_game', []);
        }

        $tw = new TwentyOne($session->get("current_game"));
        $session->set('current_game', $tw->getCurrentGame());

        return $this->render('game/game.html.twig');
    }

    #[Route('/game/doc', name: 'game_doc')]
    public function game_doc(): Response
    {
        return $this->render('game/game_doc.html.twig');
    }

    #[Route('/game/start', name: 'game_start')]
    public function game_start(SessionInterface $session): Response
    {
        $tw = new TwentyOne($session->get("current_game"));
        $gameData = $tw->getCurrentGame();

        $data = [
            'playerScore' => $gameData["playerScore"],
            'computerScore' => $gameData["computerScore"],
            'card' => $gameData["currentCard"],
            'finishedRound' => $gameData["finishedRound"],
            'resultString' => $gameData["resultString"]
        ];

        $session->set('current_game', $gameData);

        return $this->render('game/game_start.html.twig', $data);
    }

    #[Route('/game/draw', name: 'game_draw')]
    public function game_draw(SessionInterface $session): Response
    {   
        $tw = new TwentyOne($session->get("current_game"));
        $tw->playerDraw();
        
        $session->set('current_game', $tw->getCurrentGame());

        return $this->redirectToRoute('game_start');
    }

    #[Route('/game/stay', name: 'game_stay')]
    public function game_stay(SessionInterface $session): Response
    {   
        $tw = new TwentyOne($session->get("current_game"));
        $tw->computerDraw();

        $session->set('current_game', $tw->getCurrentGame());

        return $this->redirectToRoute('game_start');
    }

    #[Route('/game/reset', name: 'game_reset')]
    public function game_reset(SessionInterface $session): Response
    {   
        $session->remove('current_game');

        return $this->redirectToRoute('game_draw');
    }
}
