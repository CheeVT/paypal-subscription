<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use PayPalCheckoutSdk\Orders\OrdersCreateRequest;
use App\CreateSubscription;
use PayPalCheckoutSdk\Orders\OrdersCaptureRequest;
use App\PaypalClient;

use App\Http\Services\PayPal\Subscription;

class SubscriptionController extends Controller
{
    protected $client;

    public function __construct() {
        $this->client = PaypalClient::client();
    }    
    
    public function create() {
        //$client = PaypalClient::client();
        dd('here');
        $request = new CreateSubscription();
        $request->prefer('return=representation');
        $request->body = [
            "plan_id" => "P-4HC088875C116804UL3VBJKQ",
            "start_time" => "2020-06-18T06:00:00Z",
            "subscriber" => [[
                "name" => [
                    "given_name" => "Jovan",
                    "surname" => "Test Pp"
                ],
                "email_address" => "jovann@popwebdesign.net"
            ]],
            "application_context" => [
                "brand_name" => "Fiscal Solutions",
                "user_action" => "SUBSCRIBE_NOW",
                "payment_method" => [
                    "payer_selected" => "PAYPAL",
                    "payee_preferred" => "IMMEDIATE_PAYMENT_REQUIRED"
                ],
                "cancel_url" => "{{ url('/cancel') }}",
                "return_url" => "{{ url('/success') }}"
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

    public function subscribe() {
        $subscription = new Subscription('P-4HC088875C116804UL3VBJKQ', 'cheevt@gmail.com');
        $createdSub = $subscription->create();

        return redirect($createdSub->links[0]->href)->with('_method', 'GET');
        dd($createdSub);
        die;
        $client = new \GuzzleHttp\Client();

        $url = "https://api.sandbox.paypal.com/v1/oauth2/token";
    
    
    
        $myBody['name'] = "Demo";
    
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

        $accessToken = $res->access_token;

        $headers = [
            'Authorization' => 'Bearer ' . $accessToken,        
            'Content-Type'        => 'application/json',
        ];

        //$urlSubscription = "https://api.sandbox.paypal.com/v1/catalogs/products";

        /*$responseSubscription = $client->request('POST', $urlSubscription,  [
            "headers" => $headers,
            "json" => [
                "name" => "Fiscal 2020",
                "description" => "Fiscal Desc",
                "type" => "SERVICE",
                "category" => "SOFTWARE",
                "image_url" => "https://example.com/streaming.jpg",
                "home_url" => "https://example.com/home"
            ]
        ]);*/

        $urlSubscription = "https://api.sandbox.paypal.com/v1/billing/subscriptions";

        $responseSubscription = $client->request('POST', $urlSubscription,  [
            "headers" => $headers,
            "json" => [
                "plan_id" => "P-4HC088875C116804UL3VBJKQ",
                "subscriber" => [
                    "name" => [
                        "given_name" => "Jovan",
                        "surname" => "Test II"
                    ],
                    "email_address" => "jovan@popwebdesign.net"
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
        //dd($resSubscription);

        return redirect($resSubscription->links[0]->href)->with('_method', 'GET');
    }
}
