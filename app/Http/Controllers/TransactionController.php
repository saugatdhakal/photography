<?php

namespace App\Http\Controllers;

use App\Http\Services\TransactionService;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{

    private TransactionService $transactionService;

    public function __construct(TransactionService $transactionService)
    {
        $this->transactionService = $transactionService;
    }

    /**
     * Start Paypal transaction
     * @param Photo $id
     * @return Paypal_PAYMENT_PORTAL_LINK
     */
    public function handlePayment($id)
    {
        // return $id;
      return $this->transactionService->process($id);
    }

    /**
     * Start Paypal transaction
     * @param Photo $id
     * @return Paypal_PAYMENT_PORTAL_LINK
     */
    public function paymentSuccess(Request $request,$photo_id)
    {
      return $this->transactionService->success($request,$photo_id);
    }
    /**
     * cancel transaction.
     *
     * @return \Illuminate\Http\Response
     */
    public function paymentCancel(Request $request)
    {
        return "hello";
        return response([
            'status' => 'fail',
            'message' => 'Transaction Cancle'
        ], 401);
    }


}
