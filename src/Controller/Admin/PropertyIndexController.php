<?php

namespace App\Controller\Admin;

use App\Repository\PropertyRepository;

class PropertyIndexController extends \Symfony\Bundle\FrameworkBundle\Controller\AbstractController
{
    private $propertyRepository;


    public function __construct(PropertyRepository $propertyRepository)
    {
        $this->propertyRepository = $propertyRepository;
    }
    public function index ()
    {
        $properties = $this->propertyRepository->findAll();
        return $this->render('admin/property/index.html.twig', [
            'properties' => $properties
        ]);
    }
}