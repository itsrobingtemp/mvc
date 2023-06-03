<?php

namespace App\Card;

/**
 * The class for books for the library
 */
class Book
{   
    /**
     * Gets all books
     * 
     * @return string[]
     */
    public function getAllBookData($books) : array {
        $data = [];

        if ($books !== null) {
            foreach ($books as $book) {
                $data['books'][] = [
                    'title' => $book->getTitle(),
                    'isbn' => $book->getIsbn(),
                    'author' => $book->getAuthor(),
                    'image' => $book->getImage()
                ];
            }
        }

        return $data;
    }

    /**
     * Gets book by ISBN
     * 
     * @return string[]
     */
    public function getIsbnBookData($book) : array
    {
        $data = [];

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
}
