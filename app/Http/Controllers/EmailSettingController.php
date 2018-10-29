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
        return view('monster.email_setting.create');
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
            'driver' => 'required|string',
            'host' => 'required|string',
            'port' => 'required|integer',
            'encryption' => 'nullable|string',
            'from_address' => 'required|email',
            'from_name' => 'required|string',
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $setting = EmailSetting::create($validated);

        return redirect()->route('email_setting.index')
                ->with('toastr', 'success')
                ->with('title', 'Success!')
                ->with('message', 'New email settings created.');
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
        return view('monster.email_setting.edit', compact('emailSetting'));
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
        $validated = $request->validate([
            'driver' => 'required|string',
            'host' => 'required|string',
            'port' => 'required|integer',
            'encryption' => 'nullable|string',
            'from_address' => 'required|email',
            'from_name' => 'required|string',
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $emailSetting->driver = $validated['driver'];
        $emailSetting->host = $validated['host'];
        $emailSetting->port = $validated['port'];
        $emailSetting->encryption = $validated['encryption'];
        $emailSetting->from_address = $validated['from_address'];
        $emailSetting->from_name = $validated['from_name'];
        $emailSetting->username = $validated['username'];
        $emailSetting->password = $validated['password'];

        $updated = $emailSetting->save();

        return redirect()->route('email_setting.index')
                ->with('toastr', 'success')
                ->with('title', 'Success!')
                ->with('message', 'Email settings saved.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\EmailSetting  $emailSetting
     * @return \Illuminate\Http\Response
     */
    public function destroy(EmailSetting $emailSetting)
    {
        $deleted = $emailSetting->delete();

        if($deleted)
        {
            return redirect()->route('email_setting.index')
                ->with('toastr', 'success')
                ->with('title', 'Success!')
                ->with('message', 'Settings deleted.');
        } else {
            return redirect()->route('email_setting.index')
                ->with('toastr', 'error')
                ->with('title', 'Error!')
                ->with('message', 'Hmmm... there was some type of error with this.');
        }
    }
}
