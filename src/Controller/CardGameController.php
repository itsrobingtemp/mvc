<?php

namespace App\Controller;
use App\Card\Card;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CardGameController extends AbstractController
{
  #[Route("/card", name: "card_start")]
  public function home(): Response
  {
      return $this->render('card/home.html.twig');
  }

  #[Route("/card/deck", name: "card_deck")]
  public function deck(): Response
  {
      return $this->render('card/deck.html.twig');
  }

  #[Route("/card/deck/shuffle", name: "card_deck_shuffle")]
  public function shuffle(): Response
  {
      return $this->render('card/shuffle.html.twig');
  }

  #[Route("/card/deck/draw", name: "card_deck_draw")]
  public function draw(): Response
  {
      return $this->render('card/draw.html.twig');
  }

  #[Route("/card/deck/draw/{num<\d+>}", name: "card_deck_draw_number")]
  public function draw_number(): Response
  {
      return $this->render('card/draw_number.html.twig');
  }
}