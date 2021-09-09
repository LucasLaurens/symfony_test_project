<?php

namespace App\Manager;

use App\Entity\Order;
use App\Entity\Product;
use App\Entity\User;
use App\Services\StripeService;
use Doctrine\ORM\EntityManagerInterface;

class ProductManager {
    
    protected $em;
    protected $stripeService;

    public function __construct(EntityManagerInterface $em, StripeService $stripeService)
    {
        $this->em = $em;
        $this->stripeService = $stripeService;
    }

    public function getProducts()
    {
        return $this->em->getRepository(Product::class)->findAll();
    }

    public function getProduct($id)
    {
        return $this->em->getRepository(Product::class)->find($id);
    }

    public function intentSecret(Product $product)
    {
        $intent = $this->stripeService->paymentIntent($product);

        return $intent['client_secret'] ?? null;
    }

    /**
     * @param array $stripeParameter
     * @param Product $product
     * @return array|null
     */
    public function stripe(array $stripeParameter, Product $product)
    {
        $resource = null;
        $data = $this->stripeService->stripe($stripeParameter, $product);

        if($data) {
            $resource = [
                'stripeBrand'  => $data['charges']['data'][0]['payment_method_details']['card']['brand'],
                'stripeLast4'  => $data['charges']['data'][0]['payment_method_details']['card']['last4'],
                'stripeId'     => $data['charges']['data'][0]['id'],
                'stripeStatus' => $data['charges']['data'][0]['status'],
                'stripeToken'  => $data['client_secret']
            ];
        }

        return $resource;
    }

    /**
     * @param array $resource
     * @param Product $product
     * @param User $user
     */
    public function create_subscription(array $resource, Product $product, User $user)
    {
        $order = new Order();
        
        $order->setUser($user);
        $order->setProduct($product);
        $order->setPrice($product->getPrice());
        $order->setReference(uniqid('', false));
        $order->setBrandStripe($resource['stripeBrand']);
        $order->setLast4Stripe($resource['stripeLast4']);
        $order->setIdChargeStripe($resource['stripeId']);
        $order->setStripeToken($resource['stripeToken']);
        $order->setStatusStripe($resource['stripeStatus']);
        $order->setUpdatedAt(new \Datetime());
        $order->setCreatedAt(new \Datetime());
        
        $this->em->persist($order);
        $this->em->flush();
    }
}