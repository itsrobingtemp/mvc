<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\Library;
use Doctrine\Persistence\ManagerRegistry;
use App\Card\Book;

class ApiBookController extends AbstractController
{
    #[Route('/api/library/books', name: 'apiBooks', methods: ['GET'])]
    public function apiBooks(
        ManagerRegistry $doctrine
    ): Response {
        $entityManager = $doctrine->getManager();
        $repository = $entityManager->getRepository(Library::class);
        $books = $repository->findAll();

        $booksObj = new Book();
        $data = $booksObj->getAllBookData($books);

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

        $bookObj = new Book();
        $data = $bookObj->getIsbnBookData($book);

        $response = new JsonResponse($data);

        $response->setEncodingOptions(
            $response->getEncodingOptions() | JSON_PRETTY_PRINT
        );

        return $response;
    }
}
