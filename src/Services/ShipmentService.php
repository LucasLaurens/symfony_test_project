<?php

namespace App\Services;

use App\Entity\ShipmentInterface;
use App\Enum\ShipmentType;
use LogicException;

class ShipmentService
{
    public function specificShipmentHasNotValidState(ShipmentInterface $shipment): never
    {
        if ($shipment->getState() === ShipmentType::STATUS_CANCELED->value) {
            throw new LogicException("The shipment state is not valid");
        }
    }
}
