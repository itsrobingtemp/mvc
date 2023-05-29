<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

use App\Entity\Library;
use App\Repository\LibraryRepository;
use Doctrine\Persistence\ManagerRegistry;

class LibraryController extends AbstractController
{
    #[Route('/library', name: 'library')]
    public function library(
        LibraryRepository $libraryRepository
    ): Response {
        $books = $libraryRepository->findAll();

        $data = [
            'books' => $books
        ];

        return $this->render('library/index.html.twig', $data);
    }

    #[Route('/library/show/{bookId}', name: 'showBookById', methods: ['GET'])]
    public function showBookById(
        LibraryRepository $libraryRepository,
        int $bookId
    ): Response {
        $book = $libraryRepository
            ->find($bookId);

        $data = [
            'book' => $book
        ];

        return $this->render('library/bookById.html.twig', $data);
    }

    #[Route('/library/create', name: 'createBook', methods: ['POST'])]
    public function createBook(
        ManagerRegistry $doctrine,
        Request $request
    ): Response {
        $entityManager = $doctrine->getManager();

        $title = $request->request->get('title');
        $isbn = $request->request->get('isbn');
        $author = $request->request->get('author');
        $image = $request->request->get('image');

        $book = new Library();

        if (is_string($title) && is_string($isbn) && is_string($author) && is_string($image)) {
            $book->setTitle($title);
            $book->setIsbn($isbn);
            $book->setAuthor($author);
            $book->setImage($image);

            $entityManager->persist($book);
            $entityManager->flush();
        }

        return $this->redirectToRoute('library');
    }

    #[Route('/library/delete/{bookId}', name: 'deleteBookById', methods: ['POST'])]
    public function deleteBookById(
        ManagerRegistry $doctrine,
        int $bookId
    ): Response {
        $entityManager = $doctrine->getManager();
        $book = $entityManager->getRepository(Library::class)->find($bookId);

        if (!$book) {
            throw $this->createNotFoundException(
                'No book found for id '.$bookId
            );
        }

        $entityManager->remove($book);
        $entityManager->flush();

        return $this->redirectToRoute('library');
    }

    #[Route('/library/update/{bookId}', name: 'updateBookTemplate', methods: ['GET'])]
    public function updateBookTemplate(
        LibraryRepository $libraryRepository,
        int $bookId
    ): Response {
        $book = $libraryRepository
            ->find($bookId);

        $data = [
            'book' => $book
        ];

        return $this->render('library/bookUpdate.html.twig', $data);
    }

    #[Route('/library/updated/{bookId}', name: 'updateBook', methods: ['POST'])]
    public function updateBook(
        ManagerRegistry $doctrine,
        Request $request,
        int $bookId
    ): Response {
        $entityManager = $doctrine->getManager();
        $book = $entityManager->getRepository(Library::class)->find($bookId);

        $title = $request->request->get('title');
        $isbn = $request->request->get('isbn');
        $author = $request->request->get('author');
        $image = $request->request->get('image');

        if (!$book) {
            throw $this->createNotFoundException(
                'No books found for id '.$bookId
            );
        }

        if (is_string($title) && is_string($isbn) && is_string($author) && is_string($image)) {
            $book->setTitle($title);
            $book->setIsbn($isbn);
            $book->setAuthor($author);
            $book->setImage($image);
        }

        $entityManager->persist($book);
        $entityManager->flush();

        return $this->redirectToRoute('library');
    }
}
