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
        $this->middleware('owner')->only(['edit', 'update']);
        $this->middleware('permission:delete_contract_billings')->only('delete');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contractBillings = ContractBilling::latest()->with('user')
                    ->select('id', 'user_id', 'first_name', 'last_name', 'client_name', 'job_title', 'recruiter', 'created_at', 'approved')
                    ->limit(1000)
                    ->get();

        return view('monster.contract_billing.index', compact('contractBillings'));
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
        $deleted = $contractBilling->delete();
        if($deleted)
        {
            return redirect()->route('contract_billing.index')
                ->with('toastr', 'success')
                ->with('title', 'Success!')
                ->with('message', 'Contract Billing deleted.');
        } else {
            return redirect()->route('contract_billing.index')
                ->with('toastr', 'error')
                ->with('title', 'Error!')
                ->with('message', 'Hmmm... there was some type of error with this.');
        }
    }
}
