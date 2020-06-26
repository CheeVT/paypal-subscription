<?php

namespace App\Http\Services\PayPal;

use GuzzleHttp\Client;

class AccessToken {

  public static function getToken() {

    $url = "https://api.sandbox.paypal.com/v1/oauth2/token";

    $client = new Client();

    $response = $client->request('POST', $url,  [
        'auth' => [
            'AegwPJu2vucXLvUO_gLL9sIqYeNBF6E6QzKUCkOfT08PpDL1mIHLsEJc9GWWoLfMLLPDq8e1-dvyDRc0',
            'EHI9M6TWRd8ILubuXaFYbvHPq02f3DDLVZWvy80Eo4tF2VrvkqNq_yIia1rFsCxfN8-t39E0Sf__7VLA'
        ],
        'form_params' => [
            'grant_type' => 'client_credentials'
        ]
    ]);
            
    $res = json_decode($response->getBody()->getContents());

    //$this->accessToken = $res->access_token;
    return $res->access_token;
  }
}