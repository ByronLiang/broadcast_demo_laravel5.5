<?php

namespace App\Http\Controllers\API;

use Stripe\Stripe;

class StripeController extends Controller
{
    public function index()
    {
        Stripe::setApiKey('sk_test_bFAF5CUWd5ovl45Xt4glDqbn');
        // $customer = \Stripe\Customer::create([
        //     'email' => 'lin@gmail.com',
        //     'source'  => 'tok_1DuHEZKetdCtOinuoPWQBMpo',
        // ]);
        // $customer_data = json_decode($customer);
        $charge = \Stripe\Charge::create([
            'amount' => 215600,
            'currency' => 'JPY', 
            'source' => 'tok_1DuHMZKetdCtOinuXmWUy0mQ',
        ]);
        echo $charge;
    }

    public function creatreToken()
    {
        Stripe::setApiKey('sk_test_bFAF5CUWd5ovl45Xt4glDqbn');
        $data = \Stripe\Token::create([
            "card" => [
              "number" => "4242424242424242",
              "exp_month" => 1,
              "exp_year" => 2020,
              "cvc" => "314"
            ]
          ]);
        
        echo $charge;
    }

    public function refund()
    {
        Stripe::setApiKey('sk_test_bFAF5CUWd5ovl45Xt4glDqbn');
        $refund = \Stripe\Refund::create([
            'charge' => 'ch_1DuGJhKetdCtOinuFKR47vPl',
            'amount' => 100000,
        ]);

        echo $refund;
    }
}
