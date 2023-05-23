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
    ): Response
    {   
        $books = $libraryRepository->findAll();

        $data = [
            'books' => $books
        ];

        return $this->render('library/index.html.twig', $data);
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

        // return $this->json($book);

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
        $book->setTitle($title);
        $book->setIsbn($isbn);
        $book->setAuthor($author);
        $book->setImage($image);

        $entityManager->persist($book);
        $entityManager->flush();

        return $this->redirectToRoute('library');
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

        return $this->redirectToRoute('library');
    }

    #[Route('/library/update/{id}', name: 'updateBookTemplate', methods: ['GET'])]
    public function updateBookTemplate(
        LibraryRepository $libraryRepository,
        int $id
    ): Response {
        $book = $libraryRepository
            ->find($id);

        $data = [
            'book' => $book
        ];

        return $this->render('library/bookUpdate.html.twig', $data);
    }

    #[Route('/library/updated/{id}', name: 'updateBook', methods: ['POST'])]
    public function updateBook(
        ManagerRegistry $doctrine,
        Request $request,
        int $id
    ): Response {
        $entityManager = $doctrine->getManager();
        $book = $entityManager->getRepository(Library::class)->find($id);

        $title = $request->request->get('title');
        $isbn = $request->request->get('isbn');
        $author = $request->request->get('author');
        $image = $request->request->get('image');

        if (!$book) {
            throw $this->createNotFoundException(
                'No books found for id '.$id
            );
        }

        $book->setTitle($title);
        $book->setIsbn($isbn);
        $book->setAuthor($author);
        $book->setImage($image);

        $entityManager->persist($book);
        $entityManager->flush();

        return $this->redirectToRoute('library');
    }
}
