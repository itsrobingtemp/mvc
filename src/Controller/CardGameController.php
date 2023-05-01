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
      // Reset & set session
      $session->set('current_cards', null);
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
      $card = $deck->getRandomCard();
      $cardCount = count($deck->getCards());

      // Add to drawn cards session
      $currentCards[] = $card;
      $session->set('current_cards', $currentCards);

      $data = [
        'card' => $card,
        'count' => $cardCount - 1,
        'cards' => $currentCards
      ];

      return $this->render('card/draw.html.twig', $data);
  }

  #[Route("/card/deck/draw/{num}", name: "draw_number")]
  public function drawNumber(array $_route_params, SessionInterface $session): Response
  {
    $num = $_route_params['num'];
    $currentCards = $session->get('current_cards', []);

    $deck = new DeckOfCards($currentCards);
    $cards = $deck->getNumberCards($num);
    $cardCount = count($deck->getCards());

    foreach ($cards as $card) {
      $currentCards[] = $card;
    }

    // Add to drawn cards session
    $session->set('current_cards', $currentCards);

    $data = [
      'cards' => $cards,
      'count' => $cardCount - $num,
    ];

    return $this->render('card/draw_number.html.twig', $data);
  }
}