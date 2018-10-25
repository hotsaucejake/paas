<?php

namespace App\Http\Controllers;

use App\ContractBilling;
use Illuminate\Http\Request;

class ContractBillingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:view_contract_billings')->only(['index', 'show']);
        $this->middleware('permission:add_contract_billings')->only(['create', 'store']);
        $this->middleware('permission:edit_contract_billings')->only(['edit', 'update']);
        $this->middleware('permission:delete_contract_billings')->only('delete');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

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
     * @param  \App\ContractBilling  $contractBilling
     * @return \Illuminate\Http\Response
     */
    public function show(ContractBilling $contractBilling)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ContractBilling  $contractBilling
     * @return \Illuminate\Http\Response
     */
    public function edit(ContractBilling $contractBilling)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ContractBilling  $contractBilling
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ContractBilling $contractBilling)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ContractBilling  $contractBilling
     * @return \Illuminate\Http\Response
     */
    public function destroy(ContractBilling $contractBilling)
    {
        //
    }
}
