<?php

namespace App\Controller\Admin;

use App\Business\Property\PropertyDeletionAction;
use App\Business\Property\PropertyDeletionHandler;
use Symfony\Component\HttpFoundation\Request;

class PropertyDeletionController extends \Symfony\Bundle\FrameworkBundle\Controller\AbstractController
{
    /**
     * @var PropertyDeletionHandler
     */
    private $handler;

    public function __construct(PropertyDeletionHandler $handler)
    {
        $this->handler = $handler;
    }
    public function delete(Request $request, int $id)
    {
        $action = new PropertyDeletionAction();
        $action->id = $id;

        if ($this->isCsrfTokenValid('delete'.$id, $request->request->get('_token')))
        {
            $this->handler->handle($action);
            $this->addFlash('success', 'Supprimé avec succes');
        }
        return $this->redirectToRoute('admin.property.index');
    }
}