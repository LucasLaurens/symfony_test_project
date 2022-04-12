<?php

declare(strict_types=1);

namespace App\Entity;

interface PostInterface
{
    public function getId(): ?int;
    public function getTitle(): ?string;
    public function getContent(): ?string;
    public function getAuthor(): ?string;
}
