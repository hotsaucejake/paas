<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PermanentPlacement;
use App\ContractBilling;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:super-admin|admin|active');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pp_all = PermanentPlacement::all()->count();
        $pp_approved = PermanentPlacement::approved()->count();
        $cb_all = ContractBilling::all()->count();
        $cb_approved = ContractBilling::approved()->count();

        return view('monster.dashboard.index', compact('pp_all', 'pp_approved', 'cb_all', 'cb_approved'));
    }

}
