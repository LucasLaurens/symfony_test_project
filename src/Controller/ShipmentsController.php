<?php

namespace App\Controller;

use App\Entity\ShipmentInterface;
use App\Enum\ShipmentType;
use App\Repository\ShipmentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ShipmentsController extends AbstractController
{
    #[Route('/shipments', name: 'app_shipments')]
    public function index(ShipmentRepository $shipmentRepository): Response
    {
        $shipment1 = $shipmentRepository->findBy([
            'state' => ShipmentInterface::STATUS_TRANSMITTED
        ]);

        $shipment2 = $shipmentRepository->findBy([
            'state' => ShipmentType::STATUS_TRANSMITTED->value
        ]);

        dd($shipment1, $shipment2);
        return $this->render('shipments/index.html.twig', [
            'controller_name' => 'ShipmentsController',
        ]);
    }
}
