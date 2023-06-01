<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AboutController extends AbstractController
{
    #[Route('/about', name: 'about')]
    public function about(): Response
    {
        $number = random_int(0, 100);

        $data = [
            'number' => $number
        ];

        return $this->render('about.html.twig', $data);
    }

    #[Route('/metrics', name: 'metrics')]
    public function metrics(): Response
    {
        return $this->render('metrics.html.twig');
    }
}
