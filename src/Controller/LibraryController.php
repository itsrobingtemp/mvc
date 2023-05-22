<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\Library;
use App\Repository\LibraryRepository;
use Doctrine\Persistence\ManagerRegistry;

class LibraryController extends AbstractController
{
    #[Route('/library', name: 'books')]
    public function books(
        LibraryRepository $libraryRepository
    ): Response
    {   
        $books = $libraryRepository->findAll();

        $data = [
            'books' => $books
        ];

        return $this->render('library/index.html.twig', $data);
    }

    #[Route('/library/create', name: 'createBook')]
    public function createBook(
        ManagerRegistry $doctrine
    ): Response {
        $entityManager = $doctrine->getManager();

        $book = new Library();
        $book->setTitle("String");
        $book->setIsbn(rand(100, 999));
        $book->setAuthor("String");
        $book->setImage("String");

        $entityManager->persist($book);
        $entityManager->flush();

        return new Response('Saved new book with id '.$book->getId());
    }

    #[Route('/library/show', name: 'showAllBooks')]
    public function showAllBooks(
        LibraryRepository $libraryRepository
    ): Response {
        $books = $libraryRepository->findAll();

        $response = $this->json($books);
        $response->setEncodingOptions(
            $response->getEncodingOptions() | JSON_PRETTY_PRINT
        );
        return $response;
    }

    #[Route('/library/show/{id}', name: 'showBookById')]
    public function showBookById(
        LibraryRepository $libraryRepository,
        int $id
    ): Response {
        $book = $libraryRepository
            ->find($id);

        return $this->json($book);
    }

    #[Route('/library/delete/{id}', name: 'deleteBookById')]
    public function deleteBookById(
        ManagerRegistry $doctrine,
        int $id
    ): Response {
        $entityManager = $doctrine->getManager();
        $book = $entityManager->getRepository(Library::class)->find($id);

        if (!$book) {
            throw $this->createNotFoundException(
                'No book found for id '.$id
            );
        }

        $entityManager->remove($book);
        $entityManager->flush();

        return $this->redirectToRoute('showAllBooks');
    }

    #[Route('/library/update/{id}/{value}', name: 'updateBook')]
    public function updateBook(
        ManagerRegistry $doctrine,
        int $id,
        int $value
    ): Response {
        $entityManager = $doctrine->getManager();
        $book = $entityManager->getRepository(Library::class)->find($id);

        if (!$book) {
            throw $this->createNotFoundException(
                'No books found for id '.$id
            );
        }

        $book->setTitle($value);
        $entityManager->flush();

        return $this->redirectToRoute('showAllBooks');
    }
}
