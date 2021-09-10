<?php

namespace App\Controller\Admin;

use App\Business\Option\OptionCreationAction;
use App\Business\Option\OptionCreationHandler;
use App\Form\OptionCreationType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class OptionCreationController extends AbstractController
{
    /**
     * @var OptionCreationHandler
     */
    private $handler;

    public function __construct(OptionCreationHandler $handler)
    {
        $this->handler = $handler;
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function new(Request $request): Response
    {
        $action = new OptionCreationAction();

        $form = $this->createForm(OptionCreationType::class, $action);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $this->handler->handle($action);

            return $this->redirectToRoute('admin.option.index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/option/new.html.twig', [
            'form' => $form,
        ]);
    }
}