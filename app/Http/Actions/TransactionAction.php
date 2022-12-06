<?php

namespace App\Http\Actions;

use App\Models\CustomerTransation;
use App\Models\Transaction;

class TransactionAction
{

    /**
     * Store Response of  Paypal Success Transaction.
     * @return string $id
     * @param object $request
     */
    public function transactionStore($request): string
    {
        // Initilizing Variables
        $purchaseUnit = $request->purchase_units[0];
        $purchaseUnitCapture = $purchaseUnit->payments->captures[0];
        $purchaseUnitPayment = $purchaseUnitCapture->amount;
        $purchaseShippingAddress =  $purchaseUnit->shipping->address;
        // $address Example :1 Main St,San Jose,CA95131 US
        $address = $purchaseShippingAddress->address_line_1 . ','
            . $purchaseShippingAddress->admin_area_2 . ','
            . $purchaseShippingAddress->admin_area_1 . ' '
            . $purchaseShippingAddress->postal_code . ' '
            . $purchaseShippingAddress->country_code;

        $transaction = new Transaction();
        $transaction->cust_name = $purchaseUnit->shipping->name->full_name;
        $transaction->cust_email = $request->payer->email_address;
        $transaction->payment_id = $request->id;
        $transaction->address = $address;
        $transaction->payer_id = $request->payer->payer_id;
        $transaction->amount = $purchaseUnitPayment->value;
        $transaction->currency = $purchaseUnitPayment->currency_code;
        $transaction->payment_date = date('Y-m-d h=>i=>s', strtotime($purchaseUnitCapture->create_time));
        $transaction->payment_status = true;
        $transaction->save();
        return $transaction->id;
    }

    /**
     * Store Response of  Paypal Success Transaction.
     * @return string $id
     * @param object $transactionId
     * @param object $photo_id
     */
    public function customerTransactionStore($transactionId, $photo_id): string
    {

        $customerTransaction = new CustomerTransation();
        $customerTransaction->transaction_id = $transactionId;
        $customerTransaction->photo_id = $photo_id;
        $customerTransaction->save();
        return $customerTransaction->id;
    }
}
