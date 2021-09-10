<?php

namespace App\Controller\Admin;

use App\Business\Property\PropertyEditionAction;
use App\Business\Property\PropertyEditionHandler;
use App\Business\Property\PropertyReadAction;
use App\Business\Property\PropertyReadHandler;
use App\Form\PropertyEditionType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;

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

    public function __construct(PropertyEditionHandler $handler, PropertyReadHandler $handlerRead)
    {
        $this->handler      = $handler;
        $this->handlerRead = $handlerRead;
    }

    public function edit(Request $request, int $id)
    {
        $actionRead = new PropertyReadAction();
        $actionRead->id = $id;


        $action = new PropertyEditionAction();
        $action->id = $id;

        $property = $this->handlerRead->handle($actionRead);

        $action->title = $property->getTitle();
        $action->sold = $property->getSold();
        $action->options = $property->getOptions();
        $action->postal_code = $property->getPostalCode();
        $action->adress = $property->getAdress();
        $action->city = $property->getCity();
        $action->heat = $property->getHeat();
        $action->price = $property->getPrice();
        $action->floor = $property->getFloor();
        $action->rooms = $property->getRooms();
        $action->bedrooms = $property->getBedrooms();
        $action->surface = $property->getSurface();
        $action->description = $property->getDescription();

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