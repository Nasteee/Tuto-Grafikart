<?php

namespace App\Controller\Admin;

use App\Entity\Property;
use App\Form\PropertyType;
use App\Repository\PropertyRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;


class AdminPropertyController extends AbstractController
{
    /**
     * @var
     */
    private $propertyRepository;

    /**
     * @var
     */
    private $entityManager;

    public function __construct(PropertyRepository $propertyRepository, EntityManagerInterface $entityManager)
    {
        $this->propertyRepository = $propertyRepository;
        $this->entityManager      = $entityManager;

    }

    /**
     * @Route ("/admin", name="admin.property.index")
     */
    public function index ()
    {
        $properties = $this->propertyRepository->findAll();
        return $this->render('admin/property/index.html.twig', [
            'properties' => $properties
        ]);
    }

    /**
     * @Route ("/admin/property/create", name="admin.property.new")
     */
    public function new(Request $request)
    {
        $property = new Property();
        $form = $this->createForm(PropertyType::class, $property);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $this->entityManager->persist($property);
            $this->entityManager->flush();
            $this->addFlash('success', 'Ajouter avec succes');
            return $this->redirectToRoute('admin.property.index');
        }
        return $this->render('admin/property/new.html.twig', [
            'property' => $property,
            'form'     => $form->createView()
        ]);

    }

    /**
     * @param Property $property
     * @Route ("/admin/property/{id}", name="admin.property.edit", methods="GET|POST")
     *
     */

    public function edit(Property $property, Request $request)
    {
        $form = $this->createForm(PropertyType::class, $property);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $this->entityManager->flush();
            $this->addFlash('success', 'Modifier avec succes');
            return $this->redirectToRoute('admin.property.index');
        }

        return $this->render('admin/property/edit.html.twig', [
            'property' => $property,
            'form'     => $form->createView()
        ]);
    }

    /**
     * @Route ("/admin/property/{id}", name="admin.property.delete", methods="DELETE")
     */
    public function delete(Property $property, Request $request)
    {
        if ($this->isCsrfTokenValid('delete' . $property->getId(), $request->get('_token')))
        {
            $this->entityManager->remove($property);
            $this->entityManager->flush();
            $this->addFlash('success', 'Supprimer avec succes');

        }
        return $this->redirectToRoute('admin.property.index');
    }
}