<?php

namespace App\Http\Controllers;

use App\ContractBilling;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

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
        return view('monster.contract_billing.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string',
            'mi' => 'nullable|string',
            'last_name' => 'required|string',
            'consultant_company' => 'nullable|string',
            'phone' => 'required|string',
            'email' => 'required|email',
            'address' => 'required|string',
            'client_name' => 'required|string',
            'job_title' => 'required|string',
            'job_location' => 'required|string',
            'environment' => 'required|in:onsite,remote,both',
            'hire_type' => 'required|in:w2,1099,corp to corp',
            'contract_rate' => 'required|string',
            'bill_rate' => 'required|string',
            'base_salary' => 'nullable|string',
            'project_type' => 'required|in:aug,sow',
            'issued_hardware' => 'required|in:corus360,client,none',
            'corus_email' => 'required|boolean',
            'background_check' => 'required|in:yes,no,completed',
            'travel_reporting' => 'required|boolean',
            'start_date' => 'required|date',
            'contract_period' => 'required|string',
            'drug_test' => 'required|in:no,p5,p9,p10,p11,other',
            'benefits' => 'required|boolean',
            'client_contact' => 'required|string',
            'manager' => 'required|string',
            'manager_email' => 'required|email',
            'manager_phone' => 'nullable|string',
            'recruiter' => 'required|string',
            'account_manager' => 'required|string',
            'notes' => 'nullable|string',
        ]);

        $billing = new ContractBilling([
            'user_id' => auth()->user()->id,
            'first_name' => $validated['first_name'],
            'mi' => $validated['mi'],
            'last_name' => $validated['last_name'],
            'consultant_company' => $validated['consultant_company'],
            'phone' => $validated['phone'],
            'email' => $validated['email'],
            'address' => $validated['address'],
            'client_name' => $validated['client_name'],
            'job_title' => $validated['job_title'],
            'job_location' => $validated['job_location'],
            'environment' => $validated['environment'],
            'hire_type' => $validated['hire_type'],
            'contract_rate' => $validated['contract_rate'],
            'bill_rate' => $validated['bill_rate'],
            'base_salary' => $validated['base_salary'],
            'project_type' => $validated['project_type'],
            'issued_hardware' => $validated['issued_hardware'],
            'corus_email' => $validated['corus_email'],
            'background_check' => $validated['background_check'],
            'travel_reporting' => $validated['travel_reporting'],
            'start_date' => Carbon::parse($validated['start_date'])->toDateString(),
            'contract_period' => $validated['contract_period'],
            'drug_test' => $validated['drug_test'],
            'benefits' => $validated['benefits'],
            'client_contact' => $validated['client_contact'],
            'manager' => $validated['manager'],
            'manager_email' => $validated['manager_email'],
            'manager_phone' => $validated['manager_phone'],
            'recruiter' => $validated['recruiter'],
            'account_manager' => $validated['account_manager'],
            'notes' => $validated['notes'],
        ]);

        $saved = $billing->save();

        if($saved)
        {
            return redirect()->route('contract_billing.index')
                ->with('toastr', 'success')
                ->with('title', 'Success!')
                ->with('message', 'New Contract Billing Form Submitted.');
        } else {
            return back()
                ->with('toastr', 'error')
                ->with('title', 'Error!')
                ->with('message', 'Hmmm... there was some type of error with this.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ContractBilling  $contractBilling
     * @return \Illuminate\Http\Response
     */
    public function show(ContractBilling $contractBilling)
    {
        return view('monster.contract_billing.show', compact('contractBilling'));
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
