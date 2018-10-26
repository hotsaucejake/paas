<?php

namespace App\Http\Controllers;

use App\PermanentPlacement;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class PermanentPlacementController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:view_permanent_placements')->only(['index', 'show']);
        $this->middleware('permission:add_permanent_placements')->only(['create', 'store']);
        $this->middleware('owner')->only(['edit', 'update']);
        $this->middleware('permission:delete_permanent_placements')->only('delete');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $permanentPlacements = PermanentPlacement::latest()->with('user')
                    ->select('id', 'user_id', 'customer_name', 'customer_po', 'placement_name', 'position', 'recruiter', 'created_at', 'approved')
                    ->limit(1000)
                    ->get();

        return view('monster.permanent_placement.index', compact('permanentPlacements'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('monster.permanent_placement.create');
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
            'customer_name' => 'required|string',
            'ap_contact' => 'required|string',
            'ap_email' => 'required|email',
            'ap_phone' => 'required|string',
            'customer_po' => 'nullable|string',
            'customer_status' => 'required|in:new,existing',
            'bill_address' => 'required|string',
            'placement_name' => 'required|string',
            'placement_phone' => 'required|string',
            'placement_email' => 'required|email',
            'position' => 'required|string',
            'salary' => 'required|string',
            'perm_fee' => 'required|string',
            'total_fee' => 'required|string',
            'start_date' => 'required|date',
            'recruiter' => 'required|string',
            'sales_rep' => 'required|string',
            'special_notes' => 'nullable|string',
        ]);

        $placement = new PermanentPlacement([
            'user_id' => auth()->user()->id,
            'customer_name' => $validated['customer_name'],
            'ap_contact' => $validated['ap_contact'],
            'ap_email' => $validated['ap_email'],
            'ap_phone' => $validated['ap_phone'],
            'customer_po' => $validated['customer_po'],
            'customer_status' => $validated['customer_status'],
            'bill_address' => $validated['bill_address'],
            'placement_name' => $validated['placement_name'],
            'placement_email' => $validated['placement_email'],
            'placement_phone' => $validated['placement_phone'],
            'position' => $validated['position'],
            'salary' => $validated['salary'],
            'perm_fee' => $validated['perm_fee'],
            'total_fee' => $validated['total_fee'],
            'start_date' => Carbon::parse($validated['start_date'])->toDateString(),
            'recruiter' => $validated['recruiter'],
            'sales_rep' => $validated['sales_rep'],
            'special_notes' => $validated['special_notes'],
        ]);

        $saved = $placement->save();

        if($saved)
        {
            return redirect()->route('permanent_placement.index')
                ->with('toastr', 'success')
                ->with('title', 'Success!')
                ->with('message', 'New Permanent Placement Form Submitted.');
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
     * @param  \App\PermanentPlacement  $permanentPlacement
     * @return \Illuminate\Http\Response
     */
    public function show(PermanentPlacement $permanentPlacement)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PermanentPlacement  $permanentPlacement
     * @return \Illuminate\Http\Response
     */
    public function edit(PermanentPlacement $permanentPlacement)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PermanentPlacement  $permanentPlacement
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PermanentPlacement $permanentPlacement)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PermanentPlacement  $permanentPlacement
     * @return \Illuminate\Http\Response
     */
    public function destroy(PermanentPlacement $permanentPlacement)
    {
        $deleted = $permanentPlacement->delete();
        if($deleted)
        {
            return redirect()->route('permanent_placement.index')
                ->with('toastr', 'success')
                ->with('title', 'Success!')
                ->with('message', 'Permanent Placement deleted.');
        } else {
            return redirect()->route('permanent_placement.index')
                ->with('toastr', 'error')
                ->with('title', 'Error!')
                ->with('message', 'Hmmm... there was some type of error with this.');
        }
    }
}
