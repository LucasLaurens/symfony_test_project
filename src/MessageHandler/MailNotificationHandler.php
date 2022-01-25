<?php
 
namespace App\MessageHandler;
 
use App\Message\MailNotification;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;
use Symfony\Component\Mime\Email;
 
class MailNotificationHandler implements MessageHandlerInterface
{
    public function __construct(private MailerInterface $mailer)
    {
    }
 
    public function __invoke(MailNotification $message)
    {
        $email = (new Email())
            ->from('me@example.com')
            ->to('you@example.com')
            ->subject('#' . $message->getId() . ' - ' . $message->getSubject())
            ->html('<p>' . $message->getContent() . '</p>');

        sleep(10);
 
        $this->mailer->send($email);
    }
}
