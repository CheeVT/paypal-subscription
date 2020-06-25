<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use PayPalCheckoutSdk\Orders\OrdersCreateRequest;
use App\CreatePlan;
use PayPalCheckoutSdk\Orders\OrdersCaptureRequest;
use App\PaypalClient;

class PlansController extends Controller
{
    protected $client;

    public function __construct() {
        $this->client = PaypalClient::client();
    }    
    
    public function create() {
        //$client = PaypalClient::client();

        $request = new CreatePlan();
        $request->prefer('return=representation');
        $request->body = [
            "product_id" => "PROD-123DESC",
            "name" => "Video Streaming Service Plan",
            "description" => "Video Streaming Service basic plan",
            "status" => "ACTIVE",
            /*"application_context" => [
                "cancel_url" => "https://example.com/cancel",
                "return_url" => "https://example.com/return"
            ],*/
            "billing_cycles" => [[
                "frequency" => [
                    "interval_unit" => "MONTH",
                    "interval_count" => 1,
                    "tenure_type" => "TRIAL",
                    "sequence" => 1,
                    "total_cycles" => 2,
                    "pricing_scheme" => [
                        "fixed_price" => [
                            "value" => "3",
                            "currency_code" => "USD"
                        ]
                    ]
                ]
            ]],
            "payment_preferences" => [
                "auto_bill_outstanding" => true,
                "setup_fee" => [
                    "value" => "10",
                    "currency_code" => "USD"
                ],
                "setup_fee_failure_action" => "CONTINUE",
                "payment_failure_threshold" => 3
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
