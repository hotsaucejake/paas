<?php

namespace App\Http\Controllers;

use App\PermanentPlacement;
use App\Exports\PermanentPlacementsExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Mail\PermanentPlacementSubmitted;
use Illuminate\Support\Facades\Mail;
use App\DistributionList;

class PermanentPlacementController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:view_permanent_placements')->only(['index', 'show']);
        $this->middleware('permission:add_permanent_placements')->only(['create', 'store']);
        $this->middleware('owner')->only(['edit', 'update']);
        $this->middleware('permission:delete_permanent_placements')->only('delete');
        $this->middleware('permission:export_permanent_placements')->only('export');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $permanentPlacements = PermanentPlacement::latest()->with('user')
                    ->orderBy('id', 'desc')
                    ->select('id', 'user_id', 'customer_name', 'customer_po', 'placement_name', 'position', 'recruiter', 'created_at', 'approved')
                    ->paginate(250);

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

        $subject = 'Needs Approval: New Permanent Placement Form Submitted';
        $message = 'Permanent Placement Form #' . $placement->id . ' has been submitted and is awaiting approval.';

        $list = DistributionList::find(4); // Corus360 Permanent Placement Approval
        $emails = $list->distributionEmails;

        if($emails->isNotEmpty())  // make sure distribution list isn't empty
        {
            Mail::to($emails)
                ->cc($placement->user) // also send to the user
                ->send(new PermanentPlacementSubmitted($placement, $subject, $message));
        }

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
        $lists = DistributionList::all();
        return view('monster.permanent_placement.show', compact('permanentPlacement', 'lists'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PermanentPlacement  $permanentPlacement
     * @return \Illuminate\Http\Response
     */
    public function edit(PermanentPlacement $permanentPlacement)
    {
        return view('monster.permanent_placement.edit', compact('permanentPlacement'));
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


        $permanentPlacement->customer_name = $validated['customer_name'];
        $permanentPlacement->ap_contact = $validated['ap_contact'];
        $permanentPlacement->ap_email = $validated['ap_email'];
        $permanentPlacement->ap_phone = $validated['ap_phone'];
        $permanentPlacement->customer_po = $validated['customer_po'];
        $permanentPlacement->customer_status = $validated['customer_status'];
        $permanentPlacement->bill_address = $validated['bill_address'];
        $permanentPlacement->placement_name = $validated['placement_name'];
        $permanentPlacement->placement_email = $validated['placement_email'];
        $permanentPlacement->placement_phone = $validated['placement_phone'];
        $permanentPlacement->position = $validated['position'];
        $permanentPlacement->salary = $validated['salary'];
        $permanentPlacement->perm_fee = $validated['perm_fee'];
        $permanentPlacement->total_fee = $validated['total_fee'];
        $permanentPlacement->start_date = Carbon::parse($validated['start_date'])->toDateString();
        $permanentPlacement->recruiter = $validated['recruiter'];
        $permanentPlacement->sales_rep = $validated['sales_rep'];
        $permanentPlacement->special_notes = $validated['special_notes'];
        $permanentPlacement->approved = 0; // all updates should be unapproved

        $updated = $permanentPlacement->save();

        if(!$permanentPlacement->approved)
        {
            $subject = 'Needs Approval: Permanent Placement Form Updated';
            $message = 'Permanent Placement Form #' . $permanentPlacement->id . ' has been updated and is awaiting approval.';

            $list = DistributionList::find(4); // Corus360 Permanent Placement Approval
            $emails = $list->distributionEmails;

            if($emails->isNotEmpty())  // make sure distribution list isn't empty
            {
                Mail::to($emails)
                    ->cc($permanentPlacement->user) // also send to the user
                    ->send(new PermanentPlacementSubmitted($permanentPlacement, $subject, $message));
            }
        }

        if($updated)
        {
            return redirect()->route('permanent_placement.index')
                ->with('toastr', 'success')
                ->with('title', 'Success!')
                ->with('message', 'Permanent Placement updated.');
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


    public function approve(Request $request, PermanentPlacement $permanentPlacement)
    {
        $validated = $request->validate([
            'distribution_list' => 'required|exists:distribution_lists,id',
        ]);

        $permanentPlacement->approved = 1;

        $approved = $permanentPlacement->save();

        if($approved){

            $subject = 'Approved: New Permanent Placement Form';
            $message = 'Permanent Placement Form #' . $permanentPlacement->id . ' has been submitted and approved.';

            $list = DistributionList::find($validated['distribution_list']);
            $emails = $list->distributionEmails;

            if($emails->isNotEmpty())  // make sure distribution list isn't empty
            {
                Mail::to($emails)
                    ->cc($permanentPlacement->user) // also send to the user
                    ->send(new PermanentPlacementSubmitted($permanentPlacement, $subject, $message));
            }

            return redirect()->route('permanent_placement.index')
                ->with('toastr', 'success')
                ->with('title', 'Success!')
                ->with('message', 'Permanent Placement approved.');

        } else {

            return back()
                ->with('toastr', 'error')
                ->with('title', 'Error!')
                ->with('message', 'Hmmm... there was some type of error with this.');
        }
    }


    public function unapprove(Request $request, PermanentPlacement $permanentPlacement)
    {
        $permanentPlacement->approved = 0;

        $unapproved = $permanentPlacement->save();

        if($unapproved){

            $subject = 'Unapproved: Permanent Placement Form';
            $message = 'Permanent Placement Form #' . $permanentPlacement->id . ' has been unapproved.';

            Mail::to($permanentPlacement->user)
                ->send(new PermanentPlacementSubmitted($permanentPlacement, $subject, $message));

            return redirect()->route('permanent_placement.index')
                ->with('toastr', 'success')
                ->with('title', 'Success!')
                ->with('message', 'Permanent Placement has been unapproved.');

        } else {

            return back()
                ->with('toastr', 'error')
                ->with('title', 'Error!')
                ->with('message', 'Hmmm... there was some type of error with this.');
        }
    }


    public function export() 
    {
        return Excel::download(new PermanentPlacementsExport, 'permanent_placements.xlsx');
    }

}
