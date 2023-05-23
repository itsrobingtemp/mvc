<?php

namespace App\Controller;

use App\Card\DeckOfCards;
use App\Card\TwentyOne;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\Library;
use App\Repository\LibraryRepository;
use Doctrine\Persistence\ManagerRegistry;

class ApiController extends AbstractController
{
    #[Route('/api', name: 'apiHome')]
    public function apiHome(): Response
    {
        return $this->render('api/api_home.html.twig');
    }

    #[Route('/api/deck', name: 'apiDeck')]
    public function apiDeck(SessionInterface $session): Response
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

    #[Route('/api/shuffle', name: 'apiShuffle', methods: ['GET', 'POST'])]
    public function apiShuffle(SessionInterface $session): Response
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

    #[Route('/api/draw', name: 'apiDraw', methods: ['GET', 'POST'])]
    public function apiDraw(SessionInterface $session): Response
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

    #[Route('/api/draw/{num}', name: 'apiDrawNumber', methods: ['POST'])]
    public function apiDrawNumber(array $_route_params, SessionInterface $session): Response
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


    #[Route('/api/game', name: 'apiGame')]
    public function apiGame(SessionInterface $session): Response
    {
        $twentyOne = new TwentyOne($session->get("current_game"));
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

    #[Route('/api/library/books', name: 'apiBooks', methods: ['GET'])]
    public function apiBooks(
        ManagerRegistry $doctrine
    ): Response
    {
        $entityManager = $doctrine->getManager();
        $repository = $entityManager->getRepository(Library::class);
        $books = $repository->findAll();

        $data = [
            'books' => []
        ];

        foreach ($books as $book) {
            $data['books'][] = [
                'title' => $book->getTitle(),
                'isbn' => $book->getIsbn(),
                'author' => $book->getAuthor(),
                'image' => $book->getImage()
            ];
        }

        $response = new JsonResponse($data);

        $response->setEncodingOptions(
            $response->getEncodingOptions() | JSON_PRETTY_PRINT
        );

        return $response;
    }
    

    #[Route('/api/library/book/{isbn}', name: 'apiBooksIsbn')]
    public function apiBooksIsbn(ManagerRegistry $doctrine, string $isbn): Response
    {
        $entityManager = $doctrine->getManager();
        $repository = $entityManager->getRepository(Library::class);
        $book = $repository->findOneBy(['isbn' => $isbn]);

        $data = [
            'books' => [
                'title' => $book->getTitle(),
                'isbn' => $book->getIsbn(),
                'author' => $book->getAuthor(),
                'image' => $book->getImage()
            ]
        ];

        $response = new JsonResponse($data);

        $response->setEncodingOptions(
            $response->getEncodingOptions() | JSON_PRETTY_PRINT
        );

        return $response;
    }
}
