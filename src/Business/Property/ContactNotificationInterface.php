<?php

namespace App\Business\Property;

use App\Entity\Contact;

interface ContactNotificationInterface
{
    /**
     * @param Contact $contact
     */
    public function notify(Contact $contact);
}