<?php

namespace App\Controller\Admin;

use App\Business\Exceptions\BusinessException;
use App\Business\Property\PropertyCreationAction;
use App\Business\Property\PropertyCreationHandler;
use App\Form\PropertyCreationType;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class PropertyCreationController extends \Symfony\Bundle\FrameworkBundle\Controller\AbstractController
{
    /**
     * @var PropertyCreationHandler
     */
    private $handler;

    /**
     * @var ValidatorInterface
     */
    private $validator;

    public function __construct(PropertyCreationHandler $handler, ValidatorInterface $validator)
    {
        $this->handler = $handler;
        $this->validator = $validator;
    }
    public function new(Request $request)
    {
        $action = new PropertyCreationAction();

        $form = $this->createForm(PropertyCreationType::class, $action);
        $form->handleRequest($request);

        $this->validator->validate($action);

        if ($form->isSubmitted() && $form->isValid())
        {
            try {
                $this->handler->handle($action);
            } catch (BusinessException $exception) {
                $errors = $exception->errors;
                foreach ($errors as $error) {
                    $property = $error->getPropertyPath();
                    $form->get($property)->addError(new FormError($error->getMessage()));
                }

                return $this->render('admin/property/new.html.twig', [
                    'form' => $form->createView()
                ]);
            }

            $this->addFlash('success', 'Ajouter avec succes');
            return $this->redirectToRoute('admin.property.index');
        }

        return $this->render('admin/property/new.html.twig', [
            'form' => $form->createView()
        ]);
    }
}