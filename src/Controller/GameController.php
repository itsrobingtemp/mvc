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

        $game = new TwentyOne($session->get("current_game"));
        $session->set('current_game', $game->getCurrentGame());

        return $this->render('game/game.html.twig');
    }

    #[Route('/game/doc', name: 'gameDoc')]
    public function gameDoc(): Response
    {
        return $this->render('game/game_doc.html.twig');
    }

    #[Route('/game/start', name: 'gameStart')]
    public function gameStart(SessionInterface $session): Response
    {
        $game = new TwentyOne($session->get("current_game"));
        $gameData = $game->getCurrentGame();

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

    #[Route('/game/draw', name: 'gameDraw')]
    public function gameDraw(SessionInterface $session): Response
    {
        $game = new TwentyOne($session->get("current_game"));

        $game->playerDraw();

        $session->set('current_game', $game->getCurrentGame());

        return $this->redirectToRoute('gameStart');
    }

    #[Route('/game/stay', name: 'gameStay')]
    public function gameStay(SessionInterface $session): Response
    {
        $game = new TwentyOne($session->get("current_game"));
        $game->computerDraw();

        $session->set('current_game', $game->getCurrentGame());

        return $this->redirectToRoute('gameStart');
    }

    #[Route('/game/reset', name: 'gameReset')]
    public function gameReset(SessionInterface $session): Response
    {
        $session->remove('current_game');

        return $this->redirectToRoute('gameDraw');
    }
}
