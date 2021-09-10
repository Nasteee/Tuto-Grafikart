<?php

namespace App\Controller\Admin;

use App\Business\Option\OptionEditionAction;
use App\Business\Option\OptionEditionHandler;
use App\Form\OptionEditionType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class OptionEditionController extends \Symfony\Bundle\FrameworkBundle\Controller\AbstractController
{
    /**
     * @var OptionEditionHandler
     */
    private $handler;

    public function __construct(OptionEditionHandler $handler)
    {
        $this->handler = $handler;
    }

    public function edit(Request $request, int $id): Response
    {
        $action = new OptionEditionAction();
        $action->id = $id;
        $action->name = 'coucou';

        $form = $this->createForm(OptionEditionType::class, $action);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $this->handler->handle($action);

            return $this->redirectToRoute('admin.option.index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/option/edit.html.twig', [
            'form' => $form,
        ]);
    }
}