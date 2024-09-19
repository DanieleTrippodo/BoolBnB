<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SponsorRequest;
use App\Models\Sponsor;
use Braintree\Gateway;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function generate(Request $request, Gateway $gateway){

        $clientToken = $gateway->clientToken()->generate();

        $data = [
            'success' => true,
            'token' => $clientToken
        ];

        return response($data, 200);

    }

    public function makePayment(SponsorRequest $request, Gateway $gateway){

        $sponsor = Sponsor::find($request->sponsor);

        $result = $gateway->transaction()->sale([
            'amount' => $sponsor->cost,
            'paymentMethodNonce' => $request->token,
            'options' => [
                'submitForSettlement' => True
            ]
        ]);

        if($result->success){
            $data = [
                'success' => true,
                'message' => "Transazione eseguita con Successo!"
            ];
            return response($data, 200);
        }else{
            $data = [
                'success' => false,
                'message' => "Transazione Fallita!"
            ];
            return response($data, 401);
        };

    }

}
