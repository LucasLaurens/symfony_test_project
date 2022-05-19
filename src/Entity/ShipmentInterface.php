<?php

namespace App\Entity;

interface ShipmentInterface
{
    public const STATUS_NEW = 'new';
    public const STATUS_READY_TO_BE_TRANSMIT = 'ready_to_be_transmit';
    public const STATUS_TRANSMITTED = 'transmitted';
    public const STATUS_SHIPPED = 'shipped';
    public const STATUS_DELIVERED = 'delivered';

    public function getId(): ?int;

    public function getCode(): ?string;

    public function setCode(string $code): self;

    public function getState(): ?string;

    public function setState(string $state): self;
}
