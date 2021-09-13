<?php

namespace App\Controller\Admin;

use App\Business\Option\OptionEditionAction;
use App\Business\Option\OptionEditionHandler;
use App\Business\Option\OptionReadAction;
use App\Business\Option\OptionReadHandler;
use App\Form\OptionEditionType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class OptionEditionController extends \Symfony\Bundle\FrameworkBundle\Controller\AbstractController
{
    /**
     * @var OptionEditionHandler
     */
    private $handler;

    /**
     * @var OptionReadHandler
     */
    private $handlerRead;

    /**
     * @var ValidatorInterface
     */
    private $validator;

    public function __construct(
        OptionEditionHandler $handler,
        OptionReadHandler $handlerRead,
        ValidatorInterface $validator
    )
    {
        $this->handler      = $handler;
        $this->handlerRead  = $handlerRead;
        $this->validator    = $validator;
    }

    public function edit(Request $request, int $id): Response
    {
        $action = new OptionEditionAction();
        $action->id = $id;

        $actionRead = new OptionReadAction();
        $actionRead->id = $id;

        $action->name = $this->handlerRead->handle($actionRead)->getName();

        $this->validator->validate($action);
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