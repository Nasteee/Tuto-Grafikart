<?php

namespace App\Controller;

use App\Business\Property\ContactSendingAction;
use App\Business\Property\ContactSendingHandler;
use App\Entity\Contact;
use App\Entity\Property;
use App\Form\ContactType;
use App\Notification\ContactNotification;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class PropertyShowController extends \Symfony\Bundle\FrameworkBundle\Controller\AbstractController
{
    /**
     * @var ContactSendingHandler
     */
    private $handler;

    public function __construct(ContactSendingHandler $handler)
    {
        $this->handler = $handler;
    }

    /**
     * @return Response
     */
    public function show(Property $property, string $slug, Request $request): Response
    {
        if ($property->getSlug() !== $slug) {
            return $this->redirectToRoute('property.show', [
                'id' => $property->getId(),
                'slug' => $property->getSlug()
            ], 301);
        }

        $contact = new Contact();
        $contact->setProperty($property);
        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $action = new ContactSendingAction();
            $action->contact = $contact;

            $this->handler->handle($action);

            $this->addFlash('success', 'Votre email à bien été envoyé');

            return $this->redirectToRoute('property.show', [
                'id' => $property->getId(),
                'slug' => $property->getSlug()
            ]);
        }
        return $this->render('property/show.html.twig', [
            'property'      => $property,
            'current_menu'  => 'properties',
            'form'          => $form->createView()
        ]);
    }
}