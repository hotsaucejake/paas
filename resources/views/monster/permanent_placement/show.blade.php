@extends('monster.app')


@section('page-title')
PaaS: Permanent Placements
@endsection


@section('page-css')

@endsection


@section('breadcrumb-title')
Permanent Placement: View
@endsection


@section('breadcrumb-nav')
<li class="breadcrumb-item"><a href="{{ route('permanent_placement.index') }}">Permanent Placements</a></li>
<li class="breadcrumb-item active">View</li>
@endsection


@section('breadcrumb-buttons')
@if(auth()->user()->hasPermissionTo('add_permanent_placements'))<a class="btn pull-right btn-success" href="{{ route('permanent_placement.create') }}"><i class="mdi mdi-plus-circle"></i> Create</a>@endif
@if(auth()->user()->hasPermissionTo('edit_permanent_placements') || auth()->user()->id == $permanentPlacement->user_id)<a class="btn pull-right btn-warning m-r-15" href="{{ route('permanent_placement.edit', ['permanent_placement' => $permanentPlacement->id]) }}"><i class="fa fa-edit"></i> Edit</a>@endif
@endsection


@section('content')


    <div class="container">
        <div class="jumbotron">
            <h1 class="text-center">Permanent Placement Billing Request</h1>
            @if(optional($permanentPlacement->convergeCompany)->id)
                <h2 class="text-center">{{ $permanentPlacement->convergeCompany->title }}</h2>
            @endif
            <p class="text-center">Form #{{ $permanentPlacement->id }} created by <strong>{{ $permanentPlacement->user->name }}</strong> on {{ $permanentPlacement->created_at->toDateString() }}</p>
        </div>

        <div class="row">

            <div class="col-sm">
                <div class="form-group">
                    <label for="customer_name">Customer Name</label>
                    <p class="lead font-weight-bold">{{ $permanentPlacement->customer_name }}</p>
                </div>
                <div class="form-group">
                    <label for="ap_contact">AP Contact</label>
                    <p class="lead font-weight-bold">{{ $permanentPlacement->ap_contact }}</p>
                </div>
                <div class="form-group">
                    <label for="ap_email">AP Email</label>
                    <p class="lead font-weight-bold">{{ $permanentPlacement->ap_email }}</p>
                </div>
                <div class="form-group">
                    <label for="ap_phone">AP Phone</label>
                    <p class="lead font-weight-bold">{{ $permanentPlacement->ap_phone }}</p>
                </div>
                <div class="form-group">
                    <label for="customer_po">Customer PO#</label>
                    <p class="lead font-weight-bold">{{ $permanentPlacement->customer_po }}</p>
                </div>
            </div>
            <div class="col-sm">
                <div class="form-group">
                    <legend style="font-weight:400;font-size:1rem;">Customer Status</legend>
                    <p class="lead font-weight-bold">{{ ucwords($permanentPlacement->customer_status) }}</p>
                </div>
                <div class="form-group">
                    <label for="bill_address">Bill to Address</label>
                    <p class="lead font-weight-bold">{!! nl2br($permanentPlacement->bill_address) !!}</p>
                </div>
            </div>

        </div>

        <hr/>

        <h3 class="text-center">Placement Info</h3>
        <div class="row">

            <div class="col-sm">
                <div class="form-group">
                    <label for="placement_name">Placement Name</label>
                    <p class="lead font-weight-bold">{{ $permanentPlacement->placement_name }}</p>
                </div>
                <div class="form-group">
                    <label for="placement_phone">Placement Phone</label>
                    <p class="lead font-weight-bold">{{ $permanentPlacement->placement_phone }}</p>
                </div>
                <div class="form-group">
                    <label for="placement_email">Placement Email</label>
                    <p class="lead font-weight-bold">{{ $permanentPlacement->placement_email }}</p>
                </div>
                <div class="form-group">
                    <label for="position">Position</label>
                    <p class="lead font-weight-bold">{{ $permanentPlacement->position }}</p>
                </div>
                <div class="form-group">
                    <label for="salary">Salary</label>
                    <p class="lead font-weight-bold">{{ $permanentPlacement->salary }}</p>
                </div>
                <div class="form-group">
                    <label for="salary">Additional Cost</label>
                    <p class="lead font-weight-bold">{{ $permanentPlacement->additional_cost }}</p>
                </div>
            </div>

            <div class="col-sm">
                <div class="form-group">
                    <label for="perm_fee">Perm Fee Percentage</label>
                    <p class="lead font-weight-bold">{{ $permanentPlacement->perm_fee }}</p>
                </div>
                <div class="form-group">
                    <label for="total_fee">Total Fee</label>
                    <p class="lead font-weight-bold">{{ $permanentPlacement->total_fee }}</p>
                </div>
                <div class="form-group">
                    <label for="start_date">Start Date</label>
                    <p class="lead font-weight-bold">{{ $permanentPlacement->start_date }}</p>
                </div>
                <div class="form-group">
                    <label for="recruiter">Recruiter</label>
                    <p class="lead font-weight-bold">{{ $permanentPlacement->recruiter }}</p>
                </div>
                <div class="form-group">
                    <label for="sales_rep">Sales Rep</label>
                    <p class="lead font-weight-bold">{{ $permanentPlacement->sales_rep }}</p>
                </div>
            </div>

        </div>

        <div class="row">
            <div class="col-sm">
                <div class="form-group">
                    <label for="special_notes">Special Notes</label>
                    <p class="lead font-weight-bold">{!! nl2br($permanentPlacement->special_notes) !!}</p>
                </div>
            </div>
        </div>

        @if(!$permanentPlacement->approved && auth()->user()->hasPermissionTo('approve_permanent_placements'))
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-success btn-block btn-lg" data-toggle="modal" data-target="#approveModal">
                Approve
            </button>
            
            <!-- Modal -->
            <div class="modal fade" id="approveModal" tabindex="-1" role="dialog" aria-labelledby="approveModal" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="approveModalLongTitle">Approve Permanent Placement</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <form method="POST" action="{{ route('permanent_placement.approve', ['permanent_placement' => $permanentPlacement->id]) }}">
                        @csrf
                        @method('PATCH')
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="distribution_list">Distribution List<span class="text-danger">*</span></label>
                                <select class="form-control" id="distribution_list" name="distribution_list" required>
                                    @foreach($lists as $list)
                                        @if($list->id != 2 && $list->id != 4) <!-- omit approval lists -->
                                            <option value="{{ $list->id }}">{{ $list->title }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-success" onclick="return confirm('Are you sure you wish to send to this distribution list?');">
                                Approve
                            </button>
                        </div>
                    </form>
                </div>
                </div>
            </div>
        @endif

        @if($permanentPlacement->approved && auth()->user()->hasPermissionTo('approve_permanent_placements'))
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-danger btn-block btn-lg" data-toggle="modal" data-target="#unapproveModal">
                Unapprove
            </button>
            
            <!-- Modal -->
            <div class="modal fade" id="unapproveModal" tabindex="-1" role="dialog" aria-labelledby="unapproveModal" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="unapproveModalLongTitle">Unapprove Permanent Placement</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <form method="POST" action="{{ route('permanent_placement.unapprove', ['permanent_placement' => $permanentPlacement->id]) }}">
                        @csrf
                        @method('PATCH')
                        <div class="modal-body">
                            <p>This will unapprove this Placement Request</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you wish to unapprove?');">
                                Unapprove
                            </button>
                        </div>
                    </form>
                </div>
                </div>
            </div>
        @endif


    </div>



@endsection


@section('page-plugins')

@endsection
