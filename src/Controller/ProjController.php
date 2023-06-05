<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\HealthDiseaseRepository;
use Symfony\Component\Serializer\SerializerInterface;

class ProjController extends AbstractController
{
    #[Route('/proj', name: 'projIndex')]
    public function projIndex(
      HealthDiseaseRepository $healthDiseaseRepository,
      SerializerInterface $serializer
    ): Response
    {
        $dataSwedenDisease = $healthDiseaseRepository
        ->findItemsByTypeAndCountry("disease", "sweden");

        $dataSwedenDiseaseArray = $serializer->serialize($dataSwedenDisease, 'json');

        $dataWorldDisease = $healthDiseaseRepository
        ->findItemsByTypeAndCountry("disease", "world");

        $dataWorldDiseaseArray = $serializer->serialize($dataWorldDisease, 'json');

        $dataSwedenInfant = $healthDiseaseRepository
        ->findItemsByTypeAndCountry("infant", "sweden");

        $dataSwedenInfantArray = $serializer->serialize($dataSwedenInfant, 'json');

        $dataWorldInfant = $healthDiseaseRepository
        ->findItemsByTypeAndCountry("infant", "world");

        $dataWorldInfantArray = $serializer->serialize($dataWorldInfant, 'json');

        $data = [
          'dataSwedenDisease' => $dataSwedenDiseaseArray,
          'dataWorldDisease' => $dataWorldDiseaseArray,
          'dataSwedenInfant' => $dataSwedenInfantArray,
          'dataWorldInfant' => $dataWorldInfantArray
        ];

        return $this->render('proj/index.html.twig', $data);
    }

    #[Route('/proj/about', name: 'projAbout')]
    public function projAbout(): Response
    {
        return $this->render('proj/about.html.twig');
    }
}
