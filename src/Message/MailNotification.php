<?php

namespace App\Message;

class MailNotification
{
    public function __construct(private int $id, private string $subject, private string $content)
    {
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getSubject(): string
    {
        return $this->subject;
    }

    public function getContent(): string
    {
        return $this->content;
    }
}
