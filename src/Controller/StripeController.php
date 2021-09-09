<?php

namespace App\Controller;

use App\Entity\Product;
use App\Manager\ProductManager;
use App\Manager\UserManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class StripeController extends AbstractController
{

    protected $productManager;
    protected $userManager;

    public function __construct(ProductManager $productManager, UserManager $userManager)
    {
        $this->productManager = $productManager;
        $this->userManager = $userManager;
    }

    /**
     * @Route("/stripe", name="stripe", methods={"GET"})
     */
    public function index(): Response
    {
        return $this->render('stripe/index.html.twig', [
            'products' => $this->productManager->getProducts(),
        ]);
    }
 
    /**
     * @Route("/stripe/{id}", name="stripe.show", methods={"GET"})
     */
    public function show($id): Response
    {
        return $this->render('stripe/show.html.twig', [
            'user'         => $this->userManager->getUser(1),  
            'product'      => $this->productManager->getProduct($id),
            'intentSecret' => $this->productManager->intentSecret($this->productManager->getProduct($id))
        ]);
    }

    /**
     * @Route("/make-payment/{id}", name="make.payment", methods={"GET", "POST"})
     */
    public function makePayment(Request $req, Product $product)
    {

        $user = $this->userManager->getUser(1);
        
        if($req->getMethod() === "POST") {
            $resource = $this->productManager->stripe($_POST, $product);

            if(null !== $resource) {
                $this->productManager->create_subscription($resource, $product, $user);

                return $this->render('stripe/show.html.twig', [
                    'user'         => $user,  
                    'product'      => $product,
                    'intentSecret' => $this->productManager->intentSecret($this->productManager->getProduct($product->getId()))
                ]);
            }
        }
dd();
        return $this->redirectToRoute('stripe');
    }
}
