<?php

namespace App\Business\Property;

class ContactSendingHandler
{
    /**
     * @var ContactNotificationInterface
     */
    private $notification;

    public function __construct(ContactNotificationInterface $notification)
    {
        $this->notification = $notification;
    }

    /**
     * Fait une demande de visite.
     *
     * @param ContactSendingAction $action
     */
    public function handle(ContactSendingAction $action)
    {
        $this->notification->notify($action->contact);
    }
}