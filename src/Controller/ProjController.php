<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\HealthDiseaseRepository;

class ProjController extends AbstractController
{
    #[Route('/proj', name: 'projIndex')]
    public function projIndex(
      HealthDiseaseRepository $healthDiseaseRepository
    ): Response
    {
        $dataPoints = $healthDiseaseRepository
        ->findAll();

        $data = [
          'healthDisease' => $dataPoints
        ];

        return $this->render('proj/index.html.twig', $data);
    }

    #[Route('/proj/about', name: 'projAbout')]
    public function projAbout(): Response
    {
        return $this->render('proj/about.html.twig');
    }
}
