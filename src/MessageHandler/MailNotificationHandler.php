<?php

namespace App\MessageHandler;

use App\Entity\Message;
use App\Message\MailNotification;
use App\Repository\MessageRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class MailNotificationHandler implements MessageHandlerInterface
{
    public function __construct(private MailerInterface $mailer,  private EntityManagerInterface $em, private MessageRepository $messageRepository)
    {
    }

    public function __invoke(MailNotification $notification)
    {
        $email = (new Email())
            ->from('me@example.com')
            ->to('you@example.com')
            ->subject($notification->getMessage()->getSubject())
            ->html('<p>' . $notification->getMessage()->getContent() . '</p>');

        $this->mailer->send($email);

        // the 10 seconds of waiting are played in the background and therefore not visible for the customer
        sleep(10);

        try {
            $notification->getMessage()->setIsOnline(true);

            $this->em->persist($notification->getMessage());
            $this->em->flush();
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }
}
