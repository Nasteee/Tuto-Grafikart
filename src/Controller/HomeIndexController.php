<?php
namespace App\Controller;

use App\Repository\PropertyRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class HomeIndexController extends AbstractController
{

    public function index(PropertyRepository $repository): Response
    {




        // 3 services
        // meme chose mais trois manières de faire différente





        // Securité
        // Recuperation de données

        $properties = $repository->findLatest();

        return $this->render('pages/home.html.twig', [
            'properties' => $properties
        ]);
    }
}