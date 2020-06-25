<?php

namespace App;

use PayPalHttp\HttpRequest;

class CreatePlan extends HttpRequest {
    function __construct()
    {
        parent::__construct("/v1/billing/plans?", "POST");
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