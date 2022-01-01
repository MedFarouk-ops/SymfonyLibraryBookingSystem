<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use App\Entity\User;
use App\Repository\UserRepository;

class MailerController extends AbstractController
{
    /**
     * @Route("/admin/mailer/{id}", name="mailer")
     */
    public function sendEmail(MailerInterface $mailer,User $user): Response
    {
        $address = $user->getEmail() ;
        $email = (new TemplatedEmail())
            ->from('E-Library <librarylibrary652@gmail.com>')
            ->to($address)
            //->cc('cc@example.com')
            //->bcc('bcc@example.com')
            //->replyTo('fabien@example.com')
            //->priority(Email::PRIORITY_HIGH)
            ->subject('Emprunt confirmé')
            ->htmlTemplate('emails/confirmation.html.twig')
            ->context([
                'user' => $user,
                
            ]);

        $mailer->send($email);
        return $this->redirectToRoute('home');

        
    }
}
