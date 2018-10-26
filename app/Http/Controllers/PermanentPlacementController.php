<?php

namespace App\Http\Controllers;

use App\PermanentPlacement;
use Illuminate\Http\Request;

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
        //
    }
}
