<?php

namespace App\Http\Services;

use App\Http\Actions\TransactionAction;
use App\Models\CustomerTransation;
use App\Models\Photo;
use Exception;
use Illuminate\Support\Facades\DB;
use Srmklive\PayPal\Services\PayPal as PayPalClient;

class TransactionService extends TransactionAction
{
    /**
     * Initilizing and Requesting PayPal Order.
     * @param string $id Photo id
     * @return string href PayPal Link
     */
    public function process(string $id): string
    {
        $photo = Photo::getPhotoById($id);
        $provider = new PayPalClient;
        $provider->getAccessToken();
        //* Create Response Json to Pass
        $response = $provider->createOrder([
            "intent" => "CAPTURE",
            "application_context" => [
                "return_url" => route('transaction.paymentSuccess', ['photo_id' => $photo->id]),
                "cancel_url" => route('transaction.paymentCancel'),
            ],
            "purchase_units" => [
                0 => [
                    "items" => [
                        0 => [

                            "name" => $photo->title,
                            "ablum" => "Sky",
                            "description" => "Good One",
                            "quantity" => "1",
                            "unit_amount" => [
                                "currency_code" => "USD",
                                "value" => "1"
                            ]
                        ]
                    ],
                    "amount" => [
                        "currency_code" => "USD",
                        "value" => "1",
                        "breakdown" => [
                            "item_total" => [
                                "currency_code" => "USD",
                                "value" => "1.00"
                            ]
                        ]
                    ]
                ]
            ]
        ]);
        //* Checking Has Response has Id OR Not
        if (!isset($response['id']) || $response['id'] == null) {
            throw new Exception("Can't find Response id!! :TransactionService", 500);
        }
        //* redirect to approve href
        foreach ($response['links'] as $links) {
            if ($links['rel'] == 'approve') {
                return $links['href'];
            }
        }
        throw new Exception("Can't find link approve :TransactionService", 500);
    }


    /**
     * Initilizing and Requesting PayPal Order.
     * @return CustomerTransation object
     * @param object $request PayPal response (token and id)
     * @param string $photo_id Photo Id
     */
    public function success($request, string $photo_id): CustomerTransation
    {
        //* Initilizing PayPal
        $provider = new PayPalClient;
        $provider->getAccessToken();
        //* Capturing PayPal Token for verification
        $response = $provider->capturePaymentOrder($request['token']);
        if (!isset($response['status']) || $response['status'] != 'COMPLETED') {
            throw new Exception("Transaction status Failer ", 500);
        }
        //* Storing the value in DB after status is COMPLETED
        $transaction = $this->transactionStore(json_decode(json_encode($response)));
        if (!$transaction) {
            throw new Exception("Fail to Store Transaction ", 500);
        }
        $customerTransaction = $this->customerTransactionStore($transaction->id, $photo_id);
        if (!$customerTransaction) {
            throw new Exception('Fail to Store Customer Transaction', 500);
        }
        return $customerTransaction;
    }
    public function transactionFailure()
    {
    }
}
