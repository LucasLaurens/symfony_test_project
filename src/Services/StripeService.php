<?php

namespace App\Services;

use App\Entity\Order;
use App\Entity\Product;

class StripeService 
{    
    private $privateKey;

    public function __construct()
    {
        if( "dev" === $_ENV['APP_ENV'] ) {
            $this->privateKey = $_ENV['STRIPE_SECRET_KEY_TEST'];
        }
    }

    /**
     * @param Product $product
     * @return \Stripe\PaymentIntent
     * @throws \Stripe\Exception\ApiErrorException
     */
    public function paymentIntent(Product $product)
    {
        \Stripe\Stripe::setApiKey($this->privateKey);

        $price = (float) $product->getPrice();        
        return \Stripe\PaymentIntent::create([
            'amount'               => $price * 100,
            'currency'             => Order::DEVISE,
            'payment_method_types' => ['card'],
        ]);
    }

    /**
     * @param [type] $amount
     * @param [type] $currency
     * @param [type] $description
     * @param array $stripeParameter
     * @return \Stripe\PaymentIntent|null
     */
    public function payment(
        $amount, 
        $currency, 
        $description,
        array $stripeParameter
    )
    {
        \Stripe\Stripe::setApiKey($this->privateKey);
        $payment_intent = null;
        if(isset($stripeParameter['stripeIntentId'])) {
            $payment_intent = \Stripe\PaymentIntent::retrieve($stripeParameter['stripeIntentId']);
        }

        // if("succeeded" === $stripeParameter['stripeIntentId']) {
        //     // TODO: make something
        // } else {
        //     $payment_intent->cancel();
        // }

        return $payment_intent;
    }

    /**
     * @param array $stripeParameter
     * @param Product $product
     * @return \Stripe\PaymentIntent|null
     */
    public function stripe(array $stripeParameter, Product $product)
    {
        $price = (float) $product->getPrice();
        return $this->payment(
           $price * 100,
           Order::DEVISE,
           $product->getName(),
           $stripeParameter
        );
    }

}