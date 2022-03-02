<?php

namespace App\Message;

use App\Entity\Message;

class MailNotification implements MailNotificationInterface
{
    public function __construct(private Message $message)
    {
    }

    public function getMessage(): Message
    {
        return $this->message;
    }
}
