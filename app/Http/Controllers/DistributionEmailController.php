<?php

namespace App\Http\Controllers;

use App\DistributionEmail;
use App\DistributionList;
use Illuminate\Http\Request;

class DistributionEmailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $emails = DistributionEmail::all();

        return view('monster.distribution_email.index', compact('emails'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $lists = DistributionList::all();

        return view('monster.distribution_email.create', compact('lists'));
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
            'email' => 'required|email',
        ]);

        $email = DistributionEmail::create($validated);

        if(isset($request->distribution_lists))
        {
            $email->distributionLists()->sync($request->distribution_lists);
        }

        return redirect()->route('distribution_email.index')
                ->with('toastr', 'success')
                ->with('title', 'Success!')
                ->with('message', 'New email created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\DistributionEmail  $distributionEmail
     * @return \Illuminate\Http\Response
     */
    public function show(DistributionEmail $distributionEmail)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\DistributionEmail  $distributionEmail
     * @return \Illuminate\Http\Response
     */
    public function edit(DistributionEmail $distributionEmail)
    {
        $lists = DistributionList::all();

        return view('monster.distribution_email.edit', compact('distributionEmail', 'lists'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\DistributionEmail  $distributionEmail
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DistributionEmail $distributionEmail)
    {
        // no need to validate because we're not updating the email
        // only update the list it belongs to

        $distributionEmail->distributionLists()->sync($request->distribution_lists);

        return redirect()->route('distribution_email.index')
                ->with('toastr', 'success')
                ->with('title', 'Success!')
                ->with('message', 'Email updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\DistributionEmail  $distributionEmail
     * @return \Illuminate\Http\Response
     */
    public function destroy(DistributionEmail $distributionEmail)
    {
        //
    }
}
