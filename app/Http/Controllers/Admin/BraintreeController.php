<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Sponsor;
use Braintree\Gateway;
use Illuminate\Http\Request;


class BraintreeController extends Controller
{
    public function token(Request $request, Gateway $gateway, Sponsor $sponsor){

        $sponsor = Sponsor::all();

        $token = $gateway->clientToken()->generate();

        if($request->input('nonce') != null){
            $nonceFromTheClient = $request->input('nonce');

            $gateway->transaction()->sale([
                'amount' => $sponsor->cost,
                'paymentMethodNonce' => $nonceFromTheClient,
                'options' => [
                    'submitForSettlement' => True
                ]
            ]);
            return view ('user.sponsorships.index');
        }else{
            $token = $gateway->clientToken()->generate();
            return view ('braintree',['token' => $token]);
        }
    }
}

