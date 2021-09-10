<?php

namespace App\Controller\Admin;

use App\Business\Property\PropertyCreationAction;
use App\Business\Property\PropertyCreationHandler;
use App\Form\PropertyCreationType;
use Symfony\Component\HttpFoundation\Request;

class PropertyCreationController extends \Symfony\Bundle\FrameworkBundle\Controller\AbstractController
{
    private $handler;

    public function __construct(PropertyCreationHandler $handler)
    {
        $this->handler = $handler;
    }
    public function new(Request $request)
    {
        $action = new PropertyCreationAction();

        $form = $this->createForm(PropertyCreationType::class, $action);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $this->handler->handle($action);
            $this->addFlash('success', 'Ajouter avec succes');
            return $this->redirectToRoute('admin.property.index');
        }
        return $this->render('admin/property/new.html.twig', [
            'form'     => $form->createView()
        ]);

    }
}