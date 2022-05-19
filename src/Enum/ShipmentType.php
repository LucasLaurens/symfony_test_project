<?php

namespace App\Enum;

enum ShipmentType: string
{
    case STATUS_NEW = 'new';
    case STATUS_READY_TO_BE_TRANSMIT = 'ready_to_be_transmit';
    case STATUS_TRANSMITTED = 'transmitted';
    case STATUS_SHIPPED = 'shipped';
    case STATUS_DELIVERED = 'delivered';
}
