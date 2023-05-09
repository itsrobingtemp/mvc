<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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
    public function game_start(): Response
    {
        $data = [
        ];

        return $this->render('game/game_start.html.twig', $data);
    }
}
