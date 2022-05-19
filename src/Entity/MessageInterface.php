<?php

namespace App\Entity;

interface MessageInterface
{
    public function getId(): ?int;
    public function getSubject(): ?string;
    public function setSubject(string $subject): self;
    public function getContent(): ?string;
    public function setContent(?string $content): self;
    public function getCreatedAt(): ?\DateTimeInterface;
    public function setCreatedAt(\DateTimeInterface $createdAt): self;
    public function getUpdatedAt(): ?\DateTimeInterface;
    public function setUpdatedAt(\DateTimeInterface $updatedAt): self;
    public function getSlug(): ?string;
    public function setSlug(?string $slug): self;
    public function getIsOnline(): ?bool;
    public function setIsOnline(bool $is_online): self;
}
