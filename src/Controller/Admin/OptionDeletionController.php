<?php

namespace App\Controller\Admin;

use App\Business\Option\OptionDeletionAction;
use App\Business\Option\OptionDeletionHandler;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class OptionDeletionController extends \Symfony\Bundle\FrameworkBundle\Controller\AbstractController
{
    /**
     * @var OptionDeletionHandler
     */
    private $handler;

    public function __construct(OptionDeletionHandler $handler)
    {
        $this->handler = $handler;
    }


    public function delete(Request $request, int $id): Response
    {
        $action = new OptionDeletionAction();
        $action->id = $id;

        if ($this->isCsrfTokenValid('delete'.$id, $request->request->get('_token')))
        {
            $this->handler->handle($action);
        }

        return $this->redirectToRoute('admin.option.index', [], Response::HTTP_SEE_OTHER);
    }
}