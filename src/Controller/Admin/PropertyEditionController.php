<?php

namespace App\Controller\Admin;

use App\Business\Property\PropertyEditionAction;
use App\Business\Property\PropertyEditionHandler;
use App\Form\PropertyEditionType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;

class PropertyEditionController extends \Symfony\Bundle\FrameworkBundle\Controller\AbstractController
{
    /**
     * @var EntityManagerInterface
     */
    private $handler;

    public function __construct(PropertyEditionHandler $handler)
    {
        $this->handler      = $handler;
    }

    public function edit(Request $request, int $id)
    {
        $action = new PropertyEditionAction();
        $action->id = $id;

        $form = $this->createForm(PropertyEditionType::class, $action);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $this->handler->handle($action);

            $this->addFlash('success', 'Modifier avec succes');
            return $this->redirectToRoute('admin.property.index');
        }

        return $this->render('admin/property/edit.html.twig', [
            'form'     => $form->createView()
        ]);
    }
}