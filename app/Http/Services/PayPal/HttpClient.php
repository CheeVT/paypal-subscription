<?php

namespace App\Http\Services\PayPal;

use GuzzleHttp\Client;

class HttpClient extends AccessToken {
  public $client;
  public $accessToken;

  public function __construct() {
    $this->client = new Client();
    $this->accessToken = AccessToken::getToken();
  }
}