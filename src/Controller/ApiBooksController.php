<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\Library;
use Doctrine\Persistence\ManagerRegistry;

class ApiBookController extends AbstractController
{
    #[Route('/api/library/books', name: 'apiBooks', methods: ['GET'])]
    public function apiBooks(
        ManagerRegistry $doctrine
    ): Response {
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

  # Non-route, get books by ISBN
  public function getIsbnBookData($book, $data)
  {
      if ($book !== null) {
          $title = $book->getTitle();
          $isbn = $book->getIsbn();
          $author = $book->getAuthor();
          $image = $book->getImage();

          if (is_string($title) && is_string($isbn) && is_string($author) && is_string($image)) {
              $data = [
                  'books' => [
                      'title' => $title,
                      'isbn' => $isbn,
                      'author' => $author,
                      'image' => $image
                  ]
              ];
          }
      }

      return $data;
  }

  #[Route('/api/library/book/{isbn}', name: 'apiBooksIsbn')]
    public function apiBooksIsbn(ManagerRegistry $doctrine, string $isbn): Response
    {
        $dataArr = [];
        $entityManager = $doctrine->getManager();
        $repository = $entityManager->getRepository(Library::class);
        $book = $repository->findOneBy(['isbn' => $isbn]);

        $data = $this->getIsbnBookData($book, $dataArr);
        $response = new JsonResponse($data);

        $response->setEncodingOptions(
            $response->getEncodingOptions() | JSON_PRETTY_PRINT
        );

        return $response;
    }
}
