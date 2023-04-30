<?php

namespace App\Controller;
use App\Card\DeckOfCards;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

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
  public function deck(SessionInterface $session): Response
  {   
      $currentCards = $session->get('current_cards', []);

      $deck = new DeckOfCards($currentCards);
      $cards = $deck->getCards();

      $data = [
        'cards' => $cards
      ];

      return $this->render('card/deck.html.twig', $data);
  }

  #[Route("/card/deck/shuffle", name: "card_deck_shuffle")]
  public function shuffle(SessionInterface $session): Response
  { 
      $currentCards = $session->get('current_cards', []);

      $deck = new DeckOfCards($currentCards);
      $deck->shuffleDeck();
      $cards = $deck->getCards();

      $data = [
        'cards' => $cards
      ];

      return $this->render('card/shuffle.html.twig', $data);
  }

  #[Route("/card/deck/draw", name: "card_deck_draw")]
  public function draw(SessionInterface $session): Response
  {   
      $currentCards = $session->get('current_cards', []);

      $deck = new DeckOfCards($currentCards);
      $cards = $deck->getRandomCard();
      $cardCount = count($deck->getCards());

      $currentCards[] = $cards;
      $session->set('current_cards', $currentCards);

      $data = [
        'card' => $cards,
        'count' => $cardCount
      ];

      return $this->render('card/draw.html.twig', $data);
  }

  #[Route("/card/deck/draw/{num<\d+>}", name: "card_deck_draw_number")]
  public function draw_number(): Response
  {
      return $this->render('card/draw_number.html.twig');
  }
}