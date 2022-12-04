<?php

namespace App\Http\Controllers;

use App\Http\Sevices\TransactionService;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Srmklive\PayPal\Services\PayPal as PayPalClient;

class TransactionController extends Controller
{

    private TransactionService $transactionService;

    public function __construct(TransactionService $transactionService)
    {
        $this->transactionService = $transactionService;
    }

    public function handlePayment()
    {
        $provider = new PayPalClient;
        // Getting headers form config/paypal.php
        $provider->setApiCredentials(config('paypal'));
        $paypalToken = $provider->getAccessToken();

        $response = $provider->createOrder([
            "intent" => "CAPTURE",
            "application_context" => [
                "return_url" => route('transaction.paymentSuccess'),
                "cancel_url" => route('transaction.paymentCancel'),
            ],
            "purchase_units" => [
                0 => [
                    "amount" => [
                        "currency_code" => "USD",
                        "value" => "1"
                    ]
                ]
            ]
        ]);

        if (isset($response['id']) && $response['id'] != null) {
            // redirect to approve href
            foreach ($response['links'] as $links) {
                if ($links['rel'] == 'approve') {
                    return $links['href'];
                    // return redirect($links['href']);
                }
            }
            return response([
                'status' => 'error',
                'message' => 'Something went wrong'
            ], 401);
        } else {
            return
                response([
                    'status' => 'error',
                    'message' => $response['message'] ?? 'Something went wrong.'
                ], 401);
        }
    }
    public function paymentSuccess(Request $request)
    {
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $provider->getAccessToken();
        $response = $provider->capturePaymentOrder($request['token']);
        if (isset($response['status']) && $response['status'] == 'COMPLETED') {
            $transaction = new Transaction();

            return redirect("/#/photo/payment/status/" + $transaction->id);
            // return response([
            //     'status' => 'success',
            //     'message' => 'Successfull transaction',
            //     'response' => $response,
            // ], 200);
        } else {
            return response([
                'status' => 'fail',
                'message' => 'Transaction failed'
            ], 401);
        }
    }
    /**
     * cancel transaction.
     *
     * @return \Illuminate\Http\Response
     */
    public function paymentCancel(Request $request)
    {
        return response([
            'status' => 'fail',
            'message' => 'Transaction Cancle'
        ], 401);
    }

    public function paymentResponse()
    {
        // return "hello";
        return json_decode(Transaction::getPaymentResponse());
    }
}
