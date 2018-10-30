<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ContractBilling;
use App\PermanentPlacement;

class MailableController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:super-admin');
    }


    public function billing(ContractBilling $contract_billing)
    {
        return (new \App\Mail\ContractBillingSubmitted($contract_billing, 'subject line', 'A new form has been submitted and is waiting for approval.'))->render();
    }


    public function placement(PermanentPlacement $permanent_placement)
    {
        return (new \App\Mail\PermanentPlacementSubmitted($permanent_placement, 'subject line', 'A new form has been submitted and is waiting for approval.'))->render();
    }
}
