<?php

namespace App\Controller\Admin;

use App\Business\Property\PropertyEditionAction;
use App\Business\Property\PropertyEditionHandler;
use App\Business\Property\PropertyReadAction;
use App\Business\Property\PropertyReadHandler;
use App\Form\PropertyEditionType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class PropertyEditionController extends \Symfony\Bundle\FrameworkBundle\Controller\AbstractController
{
    /**
     * @var PropertyEditionHandler
     */
    private $handler;

    /**
     * @var PropertyReadHandler
     */
    private $handlerRead;

    /**
     * @var ValidatorInterface
     */
    private $validator;

    public function __construct(PropertyEditionHandler $handler,
                                PropertyReadHandler $handlerRead,
                                ValidatorInterface $validator)
    {
        $this->handler      = $handler;
        $this->handlerRead  = $handlerRead;
        $this->validator    = $validator;
    }

    public function edit(Request $request, int $id)
    {
        $actionRead = new PropertyReadAction();
        $actionRead->id = $id;
        $property = $this->handlerRead->handle($actionRead);

        $action = PropertyEditionAction::hydrate($property);
        $this->validator->validate($action);

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