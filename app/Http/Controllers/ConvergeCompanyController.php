<?php

namespace App\Http\Controllers;

use App\ConvergeCompany;
use Illuminate\Http\Request;

class ConvergeCompanyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:view_admin_converge_companies')->only(['index', 'show']);
        $this->middleware('permission:add_admin_converge_companies')->only(['create', 'store']);
        $this->middleware('permission:edit_admin_converge_companies')->only(['edit', 'update']);
        $this->middleware('permission:delete_admin_converge_companies')->only('delete');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\ConvergeCompany  $convergeCompany
     * @return \Illuminate\Http\Response
     */
    public function show(ConvergeCompany $convergeCompany)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ConvergeCompany  $convergeCompany
     * @return \Illuminate\Http\Response
     */
    public function edit(ConvergeCompany $convergeCompany)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ConvergeCompany  $convergeCompany
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ConvergeCompany $convergeCompany)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ConvergeCompany  $convergeCompany
     * @return \Illuminate\Http\Response
     */
    public function destroy(ConvergeCompany $convergeCompany)
    {
        //
    }
}
