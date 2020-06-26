<?php

namespace App\Http\Services\PayPal;

class Product extends HttpClient {

  protected $name;
  protected $desc;

  public function __construct($name, $desc) {
    parent::__construct();
    $this->name = $name;
    $this->desc = $desc;
  }

  public function create() {

    $urlSubscription = "https://api.sandbox.paypal.com/v1/catalogs/products";
    
    $headers = [
      'Authorization' => 'Bearer ' . $this->accessToken,        
      'Content-Type'        => 'application/json',
    ];
    dd($headers);
    $responseSubscription = $this->client->request('POST', $urlSubscription,  [
      "headers" => $headers,
      "json" => [
        "name" => $this->name,
        "description" => $this->desc,
        "type" => "SERVICE",
        "category" => "SOFTWARE",
        "image_url" => "https://example.com/streaming.jpg",
        "home_url" => "https://example.com/home"
      ]
    ]);

    $resSubscription = json_decode($responseSubscription->getBody()->getContents());

    return $resSubscription;
  }
}