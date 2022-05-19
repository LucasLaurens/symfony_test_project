<?php

namespace App\Message;

use App\Entity\Message;

interface MailNotificationInterface
{
    public function getMessage(): Message;
}
