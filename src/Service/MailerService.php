<?php

namespace App\Service;

use Symfony\Component\Mime\Email;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\HttpFoundation\Response;




class MailerService
{
   
   public function __construct(private MailerInterface $mailer )
   {
    
   }
   
    public function sendEmail($to = "email@.fr",
    $content = '<p>See Twig integration for better HTML integration!</p>',
    $subject = 'Sending emails is fun again!'): void
    {
        $email = (new Email())
            ->from('hello@example.com')
            ->to($to)
            //->cc('cc@example.com')
            //->bcc('bcc@example.com')
            //->replyTo('fabien@example.com')
            //->priority(Email::PRIORITY_HIGH)
            ->subject('Time for Symfony Mailer!')
            ->text($subject)
            ->html($content);

         $this->mailer->send($email);

        // ...
    }
}
