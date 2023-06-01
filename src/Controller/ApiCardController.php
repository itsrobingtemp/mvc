<?php

namespace App\Controller;
use App\Card\DeckOfCards;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class ApiCardController extends AbstractController {
    #[Route('/api/deck', name: 'apiDeck')]
    public function apiDeck(SessionInterface $session): Response
    {
      $currentCards = $session->get('current_cards', []);

      if (!is_array($currentCards)) {
          $currentCards = [];
      }

      $deck = new DeckOfCards($currentCards);
      $cards = $deck->getCards();

      $data = [
          'cards' => $cards
      ];

      $response = new JsonResponse($data);

      $response->setEncodingOptions(
          $response->getEncodingOptions() | JSON_PRETTY_PRINT
      );

      return $response;
    }

    #[Route('/api/shuffle', name: 'apiShuffle', methods: ['GET', 'POST'])]
    public function apiShuffle(SessionInterface $session): Response
    {
        // Reset & set session
        $session->set('current_cards', null);
        $currentCards = $session->get('current_cards', []);

        if (!is_array($currentCards)) {
            $currentCards = [];
        }

        $deck = new DeckOfCards($currentCards);
        $deck->shuffleDeck();
        $cards = $deck->getCards();

        $data = [
            'cards' => $cards
        ];

        $response = new JsonResponse($data);

        $response->setEncodingOptions(
            $response->getEncodingOptions() | JSON_PRETTY_PRINT
        );

        return $response;
    }

    #[Route('/api/draw', name: 'apiDraw', methods: ['GET', 'POST'])]
    public function apiDraw(SessionInterface $session): Response
    {
        $currentCards = $session->get('current_cards', []);

        if (!is_array($currentCards)) {
            $currentCards = [];
        }

        $deck = new DeckOfCards($currentCards);
        $card = $deck->getRandomCard();
        $cardCount = count($deck->getCards());

        // Add to drawn cards session
        $currentCards[] = $card;
        $session->set('current_cards', $currentCards);

        $data = [
            'card' => $card,
            'count' => $cardCount - 1,
        ];

        $response = new JsonResponse($data);

        $response->setEncodingOptions(
            $response->getEncodingOptions() | JSON_PRETTY_PRINT
        );

        return $response;
    }

    #[Route('/api/draw/{num}', name: 'apiDrawNumber', methods: ['POST'])]
    public function apiDrawNumber($_route_params, SessionInterface $session): Response
    {
        /** @var string[] $_route_params */
        $num = $_route_params['num'];
        $currentCards = $session->get('current_cards', []);

        if (!is_array($currentCards)) {
            $currentCards = [];
        }

        $deck = new DeckOfCards($currentCards);
        $cards = $deck->getNumberCards(intval($num));
        $cardCount = count($deck->getCards());

        foreach ($cards as $card) {
            $currentCards[] = $card;
        }

        // Add to drawn cards session
        $session->set('current_cards', $currentCards);

        $data = [
            'cards' => $cards,
            'count' => $cardCount - intval($num),
        ];

        $response = new JsonResponse($data);

        $response->setEncodingOptions(
            $response->getEncodingOptions() | JSON_PRETTY_PRINT
        );

        return $response;
    }
}