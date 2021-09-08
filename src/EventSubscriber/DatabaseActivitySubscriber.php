<?php

namespace App\EventSubscriber;

use App\Entity\Post;
use App\Mails\PostMail;
use Doctrine\ORM\Events;
use Symfony\Component\Mailer\MailerInterface;
use Doctrine\Persistence\Event\LifecycleEventArgs;
use Doctrine\Bundle\DoctrineBundle\EventSubscriber\EventSubscriberInterface;

class DatabaseActivitySubscriber implements EventSubscriberInterface
{
    private $mailer;

    public function __construct(MailerInterface $mailer)
    {
        $this->mailer = $mailer;
    }

    public function getSubscribedEvents(): array
    {
        return [
            Events::postPersist
        ];
    }

    public function postPersist(LifecycleEventArgs $args): void
    {
        $post = $args->getObject();
        if (!$post instanceof Post) {
            return;
        }

        $mail = new PostMail($this->mailer);
        $mail->sendEmail($post);

        return;
    }

}