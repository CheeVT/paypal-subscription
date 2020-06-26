<?php

namespace App\Http\Services\PayPal;

class Subscription extends HttpClient {

  protected $plan_id;
  protected $email;

  public function __construct($plan_id, $email) {
    parent::__construct();

    $this->plan_id = $plan_id;
    $this->email = $email;
  }

  public function create() {

    $urlSubscription = "https://api.sandbox.paypal.com/v1/billing/subscriptions";
    
    $headers = [
      'Authorization' => 'Bearer ' . $this->accessToken,        
      'Content-Type'        => 'application/json',
    ]; 

    $responseSubscription = $this->client->request('POST', $urlSubscription,  [
      "headers" => $headers,
      "json" => [
        "plan_id" => $this->plan_id,
        "subscriber" => [
          "name" => [
            "given_name" => "Jovan",
            "surname" => "Test II"
          ],
          "email_address" => $this->email
        ],
        "application_context" => [
          "brand_name" => "Fiscal Test",
          "locale" => "en-US",
          "shipping_preference" => "SET_PROVIDED_ADDRESS",
          "user_action" => "SUBSCRIBE_NOW",
          "payment_method" => [
              "payer_selected" => "PAYPAL",
              "payee_preferred" => "IMMEDIATE_PAYMENT_REQUIRED",
          ],
          "cancel_url" => url('/cancel'),
          "return_url" => url('/success')
        ]
      ]
    ]);

    $resSubscription = json_decode($responseSubscription->getBody()->getContents());

    return $resSubscription;
  }
}