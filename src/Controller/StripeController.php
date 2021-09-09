<?php

namespace App\Controller;

use App\Manager\ProductManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class StripeController extends AbstractController
{

    protected $productManger;

    public function __construct(ProductManager $productManager)
    {
        $this->productManger = $productManager;
    }

    /**
     * @Route("/stripe", name="stripe", methods={"GET"})
     */
    public function index(): Response
    {
        return $this->render('stripe/index.html.twig', [
            'products' => $this->productManger->getProducts(),
        ]);
    }
 
    /**
     * @Route("/stripe/{id}", name="stripe.show", methods={"GET"})
     */
    public function show($id): Response
    {
        return $this->render('stripe/show.html.twig', [
            'product' => $this->productManger->getProduct($id),
        ]);
    }

      /**
     * @Route("/make-payment", name="make.payment", methods={"POST"})
     */
    public function makePayment(Request $req)
    {
        $price = (float) $req->get('price');
        if(isset($price) && !empty($price) && !is_nan($price)) {
            dd($price);
        }

        return $this->redirectToRoute('stripe');
    }
}
