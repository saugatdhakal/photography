<?php

namespace App\Http\Controllers;

use App\Models\CustomerTransation;
use App\Models\Transaction;
use Illuminate\Http\Request;

class CustomerTransationController extends Controller
{
    /**
     * Display a listing of the resource.
     * @param string
     * @return \Illuminate\Http\Response
     */
    public function searchCustomerTransaction($id)
    {
        $customerTransaction = CustomerTransation::with(['photo', 'transaction'])->find($id);
        if (!$customerTransaction) {
            return response()->json(array('error' => "Can't find the customer by id {$id}"), 500);
        }
        return $customerTransaction;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CustomerTransation  $customerTransation
     * @return \Illuminate\Http\Response
     */
    public function show(CustomerTransation $customerTransation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CustomerTransation  $customerTransation
     * @return \Illuminate\Http\Response
     */
    public function edit(CustomerTransation $customerTransation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CustomerTransation  $customerTransation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CustomerTransation $customerTransation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CustomerTransation  $customerTransation
     * @return \Illuminate\Http\Response
     */
    public function destroy(CustomerTransation $customerTransation)
    {
        //
    }
}
