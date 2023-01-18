<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;

use Illuminate\Http\Request;

class StripeController extends Controller {
    //
    public function index() {

        return view('users/show');
    }
    public function checkout() {
        \Stripe\Stripe::setApiKey(config('stripe.sk'));
        $session = \Stripe\Checkout\Session::create([
            'line_items' => [
                [
                    'price_data' => [
                        'currency' => 'eur',
                        'product_data' => [
                            'name' => 'Pagamento de Premium no Marketplace
                            Remova o limite de 5 anúncios!',
                        ],

                        'unit_amount' => 1000, // 10€
                    ],
                    'quantity' => 1,
                ],
            ],
            'mode' => 'payment',
            'cancel_url' => route('home'), //stripe/index'
            'success_url' => route('update_premium'),
            //'success_url' => route('update_user', Auth::user()->id/*['user' => 3]*/),
            //'success_url' => request('POST', url('/users/update/'.Auth::user()->id)),
            //'success_url' => Http::withHeaders()->post(url('/users/update/'.Auth::user()->id)),
            //'success_url' => Http::post(url('/users/update/'.Auth::user()->id)),
            //$request = Auth::user()->id,
            //'success_url' => request('POST', url('/users/update/3')),
        ]);

        return redirect()->away($session->url);
    }
    /*public function checkout() {


    }*/


    public function success() {

        return view('index');
    }
}
