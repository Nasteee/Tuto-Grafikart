<?php

namespace App\Notification;

use App\Business\Property\ContactNotificationInterface;
use App\Entity\Contact;
use Twig\Environment;

class ContactNotification implements ContactNotificationInterface
{
    /**
     * @var \Swift_Mailer
     */
    private \Swift_Mailer $mailer;
    /**
     * @var Environment
     */
    private Environment $renderer;

    public function __construct(\Swift_Mailer $mailer, Environment $renderer)
    {
        $this->mailer = $mailer;
        $this->renderer = $renderer;
    }

    public function notify(Contact $contact)
    {
        $message = (new \Swift_Message('Agence : ' . $contact->getProperty()->getTitle()))
            ->setFrom('guillaume.gabourg@altays.com')
            ->setTo('guillaume.gabourg@altays.com')
            ->setReplyTo($contact->getEmail())
            ->setBody(
                $this->renderer->render('emails/contact.html.twig', [
                        'contact' => $contact
                    ]
                ), 'text/html');

        $this->mailer->send($message);
    }
}