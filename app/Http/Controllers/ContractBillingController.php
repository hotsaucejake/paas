<?php

namespace App\Http\Controllers;

use App\ContractBilling;
use App\Exports\ContractBillingsExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Mail\ContractBillingSubmitted;
use Illuminate\Support\Facades\Mail;
use App\DistributionList;
use App\ConvergeCompany;

class ContractBillingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:view_contract_billings')->only(['index', 'show']);
        $this->middleware('permission:add_contract_billings')->only(['create', 'store']);
        $this->middleware('owner')->only(['edit', 'update']);
        $this->middleware('permission:delete_contract_billings')->only('delete');
        $this->middleware('permission:export_contract_billings')->only('export');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contractBillings = ContractBilling::latest()->with('user')
                    ->orderBy('id', 'desc')
                    ->select('id', 'user_id', 'first_name', 'last_name', 'client_name', 'job_title', 'recruiter', 'created_at', 'approved', 'active')
                    ->paginate(2000);

        return view('monster.contract_billing.index', compact('contractBillings'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $convergeCompanies = ConvergeCompany::orderBy('title', 'asc')->get();

        return view('monster.contract_billing.create', compact('convergeCompanies'));
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
            'converge_company_id' => 'required|exists:contract_billings,id',
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
            'overtime_eligible' => 'required|boolean',
            'base_salary' => 'nullable|string',
            'project_type' => 'required|in:aug,sow,pse',
            'sow' => 'nullable|string',
            'issued_hardware' => 'required|string',
            'corus_email' => 'required|boolean',
            'background_check' => 'required|in:yes,no,completed',
            'travel_reporting' => 'required|boolean',
            'concur' => 'required|boolean',
            'start_date' => 'required|date',
            'contract_period' => 'required|string',
            'drug_test' => 'required|in:no,p5,p9,p10,p11,other',
            'benefits' => 'required|boolean',
            'client_contact' => 'required|string',
            'manager' => 'required|string',
            'manager_email' => 'required|email',
            'manager_phone' => 'nullable|string',
            'paycom_id' => 'nullable|string',
            'recruiter' => 'required|string',
            'account_manager' => 'required|string',
            'notes' => 'nullable|string',
        ]);

        $billing = new ContractBilling([
            'user_id' => auth()->user()->id,
            'converge_company_id' => $validated['converge_company_id'],
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
            'overtime_eligible' => $validated['overtime_eligible'],
            'base_salary' => $validated['base_salary'],
            'project_type' => $validated['project_type'],
            'sow' => $validated['sow'],
            'issued_hardware' => $validated['issued_hardware'],
            'corus_email' => $validated['corus_email'],
            'background_check' => $validated['background_check'],
            'travel_reporting' => $validated['travel_reporting'],
            'concur' => $validated['concur'],
            'start_date' => Carbon::parse($validated['start_date'])->toDateString(),
            'contract_period' => $validated['contract_period'],
            'drug_test' => $validated['drug_test'],
            'benefits' => $validated['benefits'],
            'client_contact' => $validated['client_contact'],
            'manager' => $validated['manager'],
            'manager_email' => $validated['manager_email'],
            'manager_phone' => $validated['manager_phone'],
            'paycom_id' => $validated['paycom_id'],
            'recruiter' => $validated['recruiter'],
            'account_manager' => $validated['account_manager'],
            'notes' => $validated['notes'],
        ]);

        $saved = $billing->save();

        $subject = 'Needs Approval: New Contract Billing Form Submitted';
        $message = 'Contract Billing Form #' . $billing->id . ' has been submitted and is awaiting approval.';

        $list = DistributionList::find(2); // Corus360 Contract Billing Approval
        $emails = $list->distributionEmails;

        if($emails->isNotEmpty())  // make sure distribution list isn't empty
        {
            Mail::to($emails)
                ->cc($billing->user) // also send to the user
                ->send(new ContractBillingSubmitted($billing, $subject, $message));
        }

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
        $lists = DistributionList::all();
        return view('monster.contract_billing.show', compact('contractBilling', 'lists'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ContractBilling  $contractBilling
     * @return \Illuminate\Http\Response
     */
    public function edit(ContractBilling $contractBilling)
    {
        $convergeCompanies = ConvergeCompany::orderBy('title', 'asc')->get();

        return view('monster.contract_billing.edit', compact('contractBilling', 'convergeCompanies'));
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
        $validated = $request->validate([
            'converge_company_id' => 'required|exists:contract_billings,id',
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
            'overtime_eligible' => 'required|boolean',
            'base_salary' => 'nullable|string',
            'project_type' => 'required|in:aug,sow,pse',
            'sow' => 'nullable|string',
            'issued_hardware' => 'required|string',
            'corus_email' => 'required|boolean',
            'background_check' => 'required|in:yes,no,completed',
            'travel_reporting' => 'required|boolean',
            'concur' => 'required|boolean',
            'start_date' => 'required|date',
            'contract_period' => 'required|string',
            'drug_test' => 'required|in:no,p5,p9,p10,p11,other',
            'benefits' => 'required|boolean',
            'client_contact' => 'required|string',
            'manager' => 'required|string',
            'manager_email' => 'required|email',
            'manager_phone' => 'nullable|string',
            'paycom_id' => 'nullable|string',
            'recruiter' => 'required|string',
            'account_manager' => 'required|string',
            'notes' => 'nullable|string',
        ]);

        $contractBilling->converge_company_id = $validated['converge_company_id'];
        $contractBilling->first_name = $validated['first_name'];
        $contractBilling->mi = $validated['mi'];
        $contractBilling->last_name = $validated['last_name'];
        $contractBilling->consultant_company = $validated['consultant_company'];
        $contractBilling->phone = $validated['phone'];
        $contractBilling->email = $validated['email'];
        $contractBilling->address = $validated['address'];
        $contractBilling->client_name = $validated['client_name'];
        $contractBilling->job_title = $validated['job_title'];
        $contractBilling->job_location = $validated['job_location'];
        $contractBilling->environment = $validated['environment'];
        $contractBilling->hire_type = $validated['hire_type'];
        $contractBilling->contract_rate = $validated['contract_rate'];
        $contractBilling->bill_rate = $validated['bill_rate'];
        $contractBilling->overtime_eligible = $validated['overtime_eligible'];
        $contractBilling->base_salary = $validated['base_salary'];
        $contractBilling->project_type = $validated['project_type'];
        $contractBilling->sow = $validated['sow'];
        $contractBilling->issued_hardware = $validated['issued_hardware'];
        $contractBilling->corus_email = $validated['corus_email'];
        $contractBilling->background_check = $validated['background_check'];
        $contractBilling->travel_reporting = $validated['travel_reporting'];
        $contractBilling->concur = $validated['concur'];
        $contractBilling->start_date = Carbon::parse($validated['start_date'])->toDateString();
        $contractBilling->contract_period = $validated['contract_period'];
        $contractBilling->drug_test = $validated['drug_test'];
        $contractBilling->benefits = $validated['benefits'];
        $contractBilling->client_contact = $validated['client_contact'];
        $contractBilling->manager = $validated['manager'];
        $contractBilling->manager_email = $validated['manager_email'];
        $contractBilling->manager_phone = $validated['manager_phone'];
        $contractBilling->paycom_id = $validated['paycom_id'];
        $contractBilling->recruiter = $validated['recruiter'];
        $contractBilling->account_manager = $validated['account_manager'];
        $contractBilling->notes = $validated['notes'];
        $contractBilling->approved = 0; // all updates should be unapproved

        $updated = $contractBilling->save();

        if(!$contractBilling->approved)
        {
            $subject = 'Needs Approval: New Contract Billing Form Updated';
            $message = 'Contract Billing Form #' . $contractBilling->id . ' has been updated and is awaiting approval.';

            $list = DistributionList::find(2); // Corus360 Contract Billing Approval
            $emails = $list->distributionEmails;

            if($emails->isNotEmpty())  // make sure distribution list isn't empty
            {
                Mail::to($emails)
                    ->cc($contractBilling->user) // also send to the user
                    ->send(new ContractBillingSubmitted($contractBilling, $subject, $message));
            }
        }

        if($updated)
        {
            return redirect()->route('contract_billing.index')
                ->with('toastr', 'success')
                ->with('title', 'Success!')
                ->with('message', 'Contract Billing updated.');
        } else {
            return back()
                ->with('toastr', 'error')
                ->with('title', 'Error!')
                ->with('message', 'Hmmm... there was some type of error with this.');
        }
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


    public function approve(Request $request, ContractBilling $contractBilling)
    {
        $validated = $request->validate([
            'distribution_list' => 'required|exists:distribution_lists,id',
        ]);

        $contractBilling->approved = 1;

        $approved = $contractBilling->save();

        if($approved){

            $subject = 'Approved: New Contract Billing Form';
            $message = 'Contract Billing Form #' . $contractBilling->id . ' has been submitted and approved.';

            $list = DistributionList::find($validated['distribution_list']); // Corus360 Contract Billing Approval
            $emails = $list->distributionEmails;

            if($emails->isNotEmpty())  // make sure distribution list isn't empty
            {
                Mail::to($emails)
                    ->cc($contractBilling->user) // also send to the user
                    ->send(new ContractBillingSubmitted($contractBilling, $subject, $message));
            }

            return redirect()->route('contract_billing.index')
                ->with('toastr', 'success')
                ->with('title', 'Success!')
                ->with('message', 'Contract Billing approved.');

        } else {

            return back()
                ->with('toastr', 'error')
                ->with('title', 'Error!')
                ->with('message', 'Hmmm... there was some type of error with this.');
        }
    }


    public function unapprove(Request $request, ContractBilling $contractBilling)
    {
        $contractBilling->approved = 0;

        $unapproved = $contractBilling->save();

        if($unapproved){

            $subject = 'Unapproved: Contract Billing Form';
            $message = 'Contract Billing Form #' . $contractBilling->id . ' has been unapproved.';

            Mail::to($contractBilling->user)
                ->send(new ContractBillingSubmitted($contractBilling, $subject, $message));

            return redirect()->route('contract_billing.index')
                ->with('toastr', 'success')
                ->with('title', 'Success!')
                ->with('message', 'Contract Billing has been unapproved.');

        } else {

            return back()
                ->with('toastr', 'error')
                ->with('title', 'Error!')
                ->with('message', 'Hmmm... there was some type of error with this.');
        }
    }


    public function activeStatus(Request $request, ContractBilling $contractBilling)
    {
        $contractBilling->active = !$contractBilling->active;

        $activeStatus = $contractBilling->save();

        if($activeStatus){

            $subject = 'Active Status: Contract Billing Form';
            $message = 'Contract Billing Form #' . $contractBilling->id . ' status has been updated.';

            return back()
                ->with('toastr', 'success')
                ->with('title', 'Success!')
                ->with('message', $message);

        } else {

            return back()
                ->with('toastr', 'error')
                ->with('title', 'Error!')
                ->with('message', 'Hmmm... there was some type of error with this.');
        }
    }


    public function export() 
    {
        return Excel::download(new ContractBillingsExport, 'contract_billings.xlsx');
    }
}
