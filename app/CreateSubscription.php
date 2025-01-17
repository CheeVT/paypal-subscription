<?php

namespace App;

use PayPalHttp\HttpRequest;

class CreateSubscription extends HttpRequest {
    function __construct()
    {
        parent::__construct("/v1/billing/subscriptions?", "POST");
        $this->headers["Content-Type"] = "application/json";
    }


    public function payPalPartnerAttributionId($payPalPartnerAttributionId)
    {
        $this->headers["PayPal-Partner-Attribution-Id"] = $payPalPartnerAttributionId;
    }
    public function prefer($prefer)
    {
        $this->headers["Prefer"] = $prefer;
    }
}