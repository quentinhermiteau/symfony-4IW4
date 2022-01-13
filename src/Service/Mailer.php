<?php

namespace App\Service;

use App\Entity\User;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class Mailer {
    protected $mailer;

    public function __construct(MailerInterface $mailer)
    {
        $this->mailer = $mailer;
    }

    public function sendTextMail($to, $subject, $text) {
        $email = (new Email())
        ->to($to)
        ->subject($subject)
        ->text($text);
        
        try {
            $this->mailer->send($email);
        } catch (TransportExceptionInterface $e) {
            dump($e);exit;
        }
    }

    public function sendRegisterMail(User $user) {
        $email = (new TemplatedEmail())
        ->to($user->getEmail())
        ->subject('Welcome')
        ->htmlTemplate('emails/register.html.twig')
        ->context([
            'expiration_date' => new \DateTime('+1 hour'),
            'user' => $user
        ]);
        
        try {
            $this->mailer->send($email);
        } catch (TransportExceptionInterface $e) {
            dump($e);exit;
        }
    }
}