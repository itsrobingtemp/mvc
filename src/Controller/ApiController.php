<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class ApiController
{
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
