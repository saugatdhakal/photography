<?php

namespace App\Http\Controllers;

use App\Http\Services\TransactionService;
use App\Models\Transaction;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{

    private TransactionService $transactionService;

    public function __construct(TransactionService $transactionService)
    {
        $this->transactionService = $transactionService;
    }

    /**
     * Start Paypal transaction
     * @param string $id Photo Id
     * @return href Paypal Page
     */
    public function handlePayment($id)
    {
        try {
            $link = $this->transactionService->process($id);
            return $link;
        } catch (\Exception $ex) {
            return response()->json(['error' => $ex->getMessage()], 500);
        }
    }

    /**
     * Start Paypal transaction
     * @param string Photo_ID
     * @return Paypal_PAYMENT_PORTAL_LINK
     */
    public function paymentSuccess(Request $request, $photo_id)
    {
        DB::beginTransaction();
        try {
            $customerTransaction = $this->transactionService->success($request, $photo_id);
            DB::commit();
            return redirect("/#/photo/payment/status/" . $customerTransaction->id);
        } catch (Exception $ex) {
            DB::rollback();
            return response()->json([
                'status' => false,
                'message' => $ex->getMessage()
            ], 500);
        }
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
