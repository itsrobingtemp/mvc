<?php

namespace App\Controller;

use App\Card\DeckOfCards;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class ApiController extends AbstractController
{
    #[Route('/api', name: 'api_home')]
    public function api_home(): Response
    {
        return $this->render('api/api_home.html.twig');
    }

    #[Route('/api/deck', name: 'api_deck')]
    public function api_deck(SessionInterface $session): Response
    {
        $currentCards = $session->get('current_cards', []);

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

    #[Route('/api/shuffle', name: 'api_shuffle', methods: ['GET', 'POST'])]
    public function api_shuffle(SessionInterface $session): Response
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

        $response = new JsonResponse($data);

        $response->setEncodingOptions(
            $response->getEncodingOptions() | JSON_PRETTY_PRINT
        );

        return $response;
    }

    #[Route('/api/draw', name: 'api_draw', methods: ['GET', 'POST'])]
    public function api_draw(SessionInterface $session): Response
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
        ];

        $response = new JsonResponse($data);

        $response->setEncodingOptions(
            $response->getEncodingOptions() | JSON_PRETTY_PRINT
        );

        return $response;
    }

    #[Route('/api/draw/{num}', name: 'api_draw_number', methods: ['POST'])]
    public function api_draw_number(array $_route_params, SessionInterface $session): Response
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

        $response = new JsonResponse($data);

        $response->setEncodingOptions(
            $response->getEncodingOptions() | JSON_PRETTY_PRINT
        );

        return $response;
    }

    #[Route('/api/quote', name: 'quote')]
    public function quote(): Response
    {

        $quotes = [
          "The only way to do great work is to love what you do",
          "You miss 100% of the shots you don't take",
          'Success is not final, failure is not fatal: It is the courage to continue that counts'
        ];

        $randomKey = array_rand($quotes);
        $randomQuote = $quotes[$randomKey];
        $date = date('Y-m-d');
        $timestamp = time();

        $data = [
            'quote' => $randomQuote,
            'date' => $date,
            'timestamp' => $timestamp
        ];

        $response = new JsonResponse($data);
        $response->setEncodingOptions(
            $response->getEncodingOptions() | JSON_PRETTY_PRINT
        );
        return $response;
    }
}
