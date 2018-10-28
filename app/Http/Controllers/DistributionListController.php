<?php

namespace App\Http\Controllers;

use App\DistributionList;
use App\DistributionEmail;
use Illuminate\Http\Request;

class DistributionListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lists = DistributionList::with('distributionEmails')->orderBy('title')->get();

        return view('monster.distribution_list.index', compact('lists'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $emails = DistributionEmail::all();

        return view('monster.distribution_list.create', compact('emails'));
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
            'title' => 'required|string',
        ]);

        $list = DistributionList::create($validated);

        if(isset($request->distribution_emails))
        {
            $list->distributionEmails()->sync($request->distribution_emails);
        }

        return redirect()->route('distribution_list.index')
                ->with('toastr', 'success')
                ->with('title', 'Success!')
                ->with('message', 'New distribution list created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\DistributionList  $distributionList
     * @return \Illuminate\Http\Response
     */
    public function show(DistributionList $distributionList)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\DistributionList  $distributionList
     * @return \Illuminate\Http\Response
     */
    public function edit(DistributionList $distributionList)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\DistributionList  $distributionList
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DistributionList $distributionList)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\DistributionList  $distributionList
     * @return \Illuminate\Http\Response
     */
    public function destroy(DistributionList $distributionList)
    {
        //
    }
}
