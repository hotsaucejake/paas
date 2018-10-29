<?php

namespace App\Http\Controllers;

use App\EmailSetting;
use Illuminate\Http\Request;

class EmailSettingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:view_email_settings')->only(['index', 'show']);
        $this->middleware('permission:add_email_settings')->only(['create', 'store']);
        $this->middleware('permission:edit_email_settings')->only(['edit', 'update']);
        $this->middleware('permission:delete_email_settings')->only('delete');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $settings = EmailSetting::latest()->get();

        return view('monster.email_setting.index', compact('settings'));
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
     * @param  \App\EmailSetting  $emailSetting
     * @return \Illuminate\Http\Response
     */
    public function show(EmailSetting $emailSetting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\EmailSetting  $emailSetting
     * @return \Illuminate\Http\Response
     */
    public function edit(EmailSetting $emailSetting)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\EmailSetting  $emailSetting
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EmailSetting $emailSetting)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\EmailSetting  $emailSetting
     * @return \Illuminate\Http\Response
     */
    public function destroy(EmailSetting $emailSetting)
    {
        //
    }
}
