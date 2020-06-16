<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PayPalCheckoutSdk\Orders\OrdersCreateRequest;
use PayPalCheckoutSdk\Orders\OrdersCaptureRequest;
use App\PaypalClient;

class SubscribeController extends Controller
{
    protected $client;

    public function __construct() {
        $this->client = PaypalClient::client();
    }    
    
    public function create() {
        //$client = PaypalClient::client();

        $request = new OrdersCreateRequest();
        $request->prefer('return=representation');
        $request->body = [
            "intent" => "CAPTURE",
            "purchase_units" => [[
                "reference_id" => "test_ref_id1",
                "amount" => [
                    "value" => "100.00",
                    "currency_code" => "USD"
                ]
            ]],
            "application_context" => [
                "cancel_url" => "https://example.com/cancel",
                "return_url" => "https://example.com/return"
            ] 
        ];

        try {
            // Call API with your client and get a response for your call
            $response = $this->client->execute($request);
            
            // If call returns body in response, you can get the deserialized version from the result attribute of the response
            //print_r($response);
            return response()->json($response);
        }catch (HttpException $ex) {
            echo $ex->statusCode;
            print_r($ex->getMessage());
        }
    }

    public function execute(Request $request) {
        //dd($request->all());
        $request = new OrdersCaptureRequest(request('orderID'));
        $request->prefer('return=representation');
        try {
            // Call API with your client and get a response for your call
            $response = $this->client->execute($request);
            
            // If call returns body in response, you can get the deserialized version from the result attribute of the response
            return response()->json($response);
        }catch (HttpException $ex) {
            echo $ex->statusCode;
            print_r($ex->getMessage());
        }
    }
}
