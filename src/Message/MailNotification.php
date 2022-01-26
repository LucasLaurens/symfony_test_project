<?php

namespace App\Message;

class MailNotification
{
    public function __construct(private int $id, private string $subject, private string $content, private bool $is_online)
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

    public function getIsOnline(): string
    {
        return $this->is_online;
    }
}
