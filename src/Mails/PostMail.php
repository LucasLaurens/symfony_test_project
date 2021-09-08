<?php

namespace App\Mails;

use App\Entity\Post;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class PostMail {
    private $mailer;

    public function __construct(MailerInterface $mailer)
    {
        $this->mailer = $mailer;
    }

    public function sendEmail(Post $post): Response
    {
        $author = $post->getAuthor();
        $title = $post->getTitle();

        $email = (new Email())
            ->from("test@from.fr")
            ->to("test@to.fr")
            ->subject("L'auteur de l'article est $author")
            ->text("L'article $title vient d'être créé !");

        $this->mailer->send($email);

        return new Response("Le mail a bien été envoyé !!", 200);
    }
}