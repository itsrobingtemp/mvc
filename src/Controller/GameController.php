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
    public function game(): Response
    {
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
        if (empty($session->get('current_game', []))) {
            $session->set('current_game', []);
        }

        $tw = new TwentyOne($_SESSION["currentGame"]);
        $session->set('current_game', $tw->getCurrentGame());

        $data = [
        ];

        return $this->render('game/game_start.html.twig', $data);
    }

    #[Route('/game/draw', name: 'game_draw')]
    public function game_draw(SessionInterface $session): Response
    {   
        $tw = new TwentyOne($_SESSION["current_game"]);
        $tw->playerDraw();
        
        $session->set('current_game', $tw->getCurrentGame());

        return $this->redirectToRoute('some_route_name');
    }

    #[Route('/game/stay', name: 'game_stay')]
    public function game_stay(SessionInterface $session): Response
    {   
        $tw = new TwentyOne($_SESSION["current_game"]);
        $tw->computerDraw();

        $session->set('current_game', $tw->getCurrentGame());

        return $this->redirectToRoute('some_route_name');
    }

    #[Route('/game/reset', name: 'game_reset')]
    public function game_reset(SessionInterface $session): Response
    {   
        $session->set('current_game', []);

        return $this->redirectToRoute('some_route_name');
    }
}
