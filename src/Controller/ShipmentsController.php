<?php

namespace App\Controller;

use App\Entity\ShipmentInterface;
use App\Enum\ShipmentType;
use App\Repository\ShipmentRepository;
use App\Services\ShipmentService;
use Countable;
use Iterator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ShipmentsController extends AbstractController
{
    #[Route('/shipments', name: 'app_shipments')]
    /**
     * POC PHP8.1
     * * Enum
     * * Never
     * * Final constant
     * * Spread operator to merge some array with another one or item
     * * Explicit Octal numeral notation
     */
    public function index(
        ShipmentRepository $shipmentRepository,
        // ShipmentService $shipmentService
    ): Response {
        // $shipment1 = $shipmentRepository->findOneBy([
        //     'state' => ShipmentInterface::STATUS_TRANSMITTED
        // ]);

        // $shipment2 = $shipmentRepository->findOneBy([
        //     'state' => ShipmentType::STATUS_CANCELED->value
        // ]);

        // $shipments = $shipmentRepository->findAll();

        // dd($shipment1, $shipment2);

        // $shipmentService->specificShipmentHasNotValidState($shipment2);

        // $array1 = [1, 2, 3];
        // $array2 = [4, 5, 6];
        // $item1 = 7;

        // $finalArray = [...$array1, ...$array2, $item1];

        // dd($finalArray);

        // dd(0o16 === 16);
        // dd(0o16 === 14);

        return $this->render('shipments/index.html.twig', [
            'controller_name' => 'ShipmentsController',
        ]);
    }

    // private function count_and_iterate(Iterator&Countable $value): int
    // {
    //     return count($value);
    // }
}
