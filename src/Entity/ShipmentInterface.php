<?php

namespace App\Entity;

interface ShipmentInterface
{
    final public const STATUS_NEW = 'new';
    final public const STATUS_READY_TO_BE_TRANSMIT = 'ready_to_be_transmit';
    final public const STATUS_TRANSMITTED = 'transmitted';
    final public const STATUS_SHIPPED = 'shipped';
    final public const STATUS_DELIVERED = 'delivered';

    // public function getId(): ?int;

    public function getCode(): ?string;

    public function setCode(string $code): self;

    public function getState(): ?string;

    public function setState(string $state): self;
}
