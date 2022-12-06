<?php

namespace App\Http\Services;

use App\Http\Actions\TransactionAction;
use App\Models\Photo;
use Illuminate\Support\Facades\DB;
use Srmklive\PayPal\Services\PayPal as PayPalClient;

class TransactionService extends TransactionAction
{
    /**
     * Initilizing and Requesting PayPal Order.
     * @param string $id Photo id
     * @return string href PayPal Link
     */
    public function process($id): string
    {
        try {
            $photo = Photo::getPhotoById($id);
            //* Initilizing PayPal
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
            if (isset($response['id']) && $response['id'] != null) {
                //* redirect to approve href
                foreach ($response['links'] as $links) {
                    if ($links['rel'] == 'approve') {
                        return $links['href'];
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
        } catch (\Exception $ex) {
            return response()->json(['error' => $ex->getMessage()], 500);
        }
    }

    /**
     * Initilizing and Requesting PayPal Order.
     * @return Redirect-Links Success Pages
     * @param object $request PayPal response (token and id)
     * @param string $photo_id Photo Id
     */
    public function success($request, $photo_id)
    {
        DB::beginTransaction();
        try {
            //* Initilizing PayPal
            $provider = new PayPalClient;
            $provider->getAccessToken();

            //* Capturing PayPal Token for varification
            $response = $provider->capturePaymentOrder($request['token']);

            if (isset($response['status']) && $response['status'] == 'COMPLETED') {
                //* Storing the value in DB after status is COMPLETED
                $transactionId = (string)$this->transactionStore(json_decode(json_encode($response)));
                $customerTransactionId = (string)$this->customerTransactionStore($transactionId, $photo_id);

                DB::commit();
                return redirect("/#/photo/payment/status/" . $customerTransactionId);
            } else {
                DB::rollback();
                return response([
                    'status' => 'fail',
                    'message' => 'Transaction failed'
                ], 401);
            }
        } catch (\Exception $ex) {
            DB::rollback();
            return response()->json(['error in success' => $ex->getMessage()], 500);
        }
    }
    public function transactionFailure()
    {
    }
}
