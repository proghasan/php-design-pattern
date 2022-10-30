<?php

interface PaymentGatewayInterface
{
    public function payment($amount);
}

class PaymentProcessor
{
    private PaymentGatewayInterface $paymentGateWay;

    public function __construct(PaymentGatewayInterface $paymentGateWay)
    {
        $this->paymentGateWay = $paymentGateWay;
    }

    public function purchase($amount)
    {
        return $this->paymentGateWay->payment($amount);
    }
}

class Paypal implements PaymentGatewayInterface
{
    public function payment($amount): string
    {
        return "Your Purchase Amount:{$amount}$\nPayment Processed By Paypal\n";
    }
}

class Stripe
{
    public function makePayment($amount)
    {
        return "Your Purchase Amount:{$amount}$\nPayment Processed By Stripe\n";
    }
}


class StripeAdapter implements PaymentGatewayInterface
{
    private Stripe $stripe;
    public function __construct(Stripe $stripe)
    {
        $this->stripe=$stripe;
    }

    public function payment($amount)
    {
        return $this->stripe->makePayment($amount);
    }
}

// stripe
$stripe = new Stripe();
$stripeAdapter = new StripeAdapter($stripe);
$stripePaymentProcess = new PaymentProcessor($stripeAdapter);
echo $stripePaymentProcess->purchase(49.99).PHP_EOL;

echo "----------------------------".PHP_EOL;
// paypal
$paypal = new Paypal();
$paypalPaymentProcess = new PaymentProcessor($paypal);
echo $paypalPaymentProcess->purchase(100.99).PHP_EOL;
