<?php

namespace App\Controller\Admin;

use App\Entity\Property;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;

class PropertyDeletionController extends \Symfony\Bundle\FrameworkBundle\Controller\AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager      = $entityManager;
    }
    public function delete(Property $property, Request $request)
    {
        if ($this->isCsrfTokenValid('delete' . $property->getId(), $request->get('_token')))
        {
            $this->entityManager->remove($property);
            $this->entityManager->flush();
            $this->addFlash('success', 'Supprimé avec succes');

        }
        return $this->redirectToRoute('admin.property.index');
    }
}