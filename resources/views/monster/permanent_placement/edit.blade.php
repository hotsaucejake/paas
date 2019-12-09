@extends('monster.app')


@section('page-title')
PaaS: Permanent Placements
@endsection


@section('page-css')
<link href="https://cdn.jsdelivr.net/npm/gijgo@1.9.10/css/gijgo.min.css" rel="stylesheet" type="text/css" />
@endsection


@section('breadcrumb-title')
Permanent Placement: Edit
@endsection


@section('breadcrumb-nav')
<li class="breadcrumb-item"><a href="{{ route('permanent_placement.index') }}">Permanent Placements</a></li>
<li class="breadcrumb-item active">Edit</li>
@endsection


@section('breadcrumb-buttons')

@endsection


@section('content')

<form method="POST" action="{{ route('permanent_placement.update', ['permanent_placement' => $permanentPlacement->id]) }}">
    @csrf
    @method('PATCH')
    <div class="container">
        <div class="jumbotron">
            <h1 class="text-center">Permanent Placement Billing Request</h1>
            <p class="lead text-center">Use this form to request invoicing for a permanent placement.</p>
        </div>

        <div class="row">
            <div class="col-md-4">

            </div>

            <div class="col-md-4">
                <div class="form-group">
                    <legend style="font-weight:400;font-size:1rem;">Converge Company<span class="text-danger">*</span></legend>
                    <select class="custom-select" name="converge_company_id" style="max-width: 100%" required>
                        <option>---</option>
                        @foreach ($convergeCompanies as $convergeCompany)
                            <option value="{{ $convergeCompany->id }}" {{ $permanentPlacement->converge_company_id == $convergeCompany->id ? 'selected' : '' }}>{{ $convergeCompany->title }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col-md-4">

            </div>
        </div>

        <div class="row">

            <div class="col-sm">
                <div class="form-group">
                    <label for="customer_name">Customer Name<span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="customer_name" name="customer_name" placeholder="Name" value="{{ $permanentPlacement->customer_name }}" required>
                </div>
                <div class="form-group">
                    <label for="ap_contact">AP Contact<span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="ap_contact" name="ap_contact" placeholder="Contact" value="{{ $permanentPlacement->ap_contact }}" required>
                </div>
                <div class="form-group">
                    <label for="ap_email">AP Email<span class="text-danger">*</span></label>
                    <input type="email" class="form-control" id="ap_email" name="ap_email" placeholder="Email" value="{{ $permanentPlacement->ap_email }}" required>
                </div>
                <div class="form-group">
                    <label for="ap_phone">AP Phone<span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="ap_phone" name="ap_phone" placeholder="555-555-5555" value="{{ $permanentPlacement->ap_phone }}" required>
                </div>
                <div class="form-group">
                    <label for="customer_po">Customer PO#</label>
                    <input type="text" class="form-control" id="customer_po" name="customer_po" placeholder="PO#" value="{{ $permanentPlacement->customer_po }}">
                </div>
            </div>
            <div class="col-sm">
                <div class="form-group">
                    <legend style="font-weight:400;font-size:1rem;">Customer Status<span class="text-danger">*</span></legend>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="customer_status" id="customer_status1" value="new" {{ $permanentPlacement->customer_status == 'new' ? 'checked' : '' }} required>
                        <label class="form-check-label" for="customer_status1">New</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="customer_status" id="customer_status2" value="existing" {{ $permanentPlacement->customer_status == 'existing' ? 'checked' : '' }} required>
                        <label class="form-check-label" for="customer_status2">Existing</label>
                    </div>
                </div>
                <div class="form-group">
                    <label for="bill_address">Bill to Address<span class="text-danger">*</span></label>
                    <textarea class="form-control" id="bill_address" name="bill_address" rows="6" required>{{ $permanentPlacement->bill_address }}</textarea>
                </div>
            </div>

        </div>

        <hr/>

        <h3 class="text-center">Placement Info</h3>
        <div class="row">

            <div class="col-sm">
                <div class="form-group">
                    <label for="placement_name">Placement Name<span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="placement_name" name="placement_name" placeholder="Name" value="{{ $permanentPlacement->placement_name }}" required>
                </div>
                <div class="form-group">
                    <label for="placement_phone">Placement Phone<span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="placement_phone" name="placement_phone" placeholder="555-555-5555" value="{{ $permanentPlacement->placement_phone }}" required>
                </div>
                <div class="form-group">
                    <label for="placement_email">Placement Email<span class="text-danger">*</span></label>
                    <input type="email" class="form-control" id="placement_email" name="placement_email" placeholder="Email" value="{{ $permanentPlacement->placement_email }}" required>
                </div>
                <div class="form-group">
                    <label for="position">Position<span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="position" name="position" placeholder="Position" value="{{ $permanentPlacement->position }}" required>
                </div>
                <div class="form-group">
                    <label for="salary">Salary<span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="salary" name="salary" placeholder="$" value="{{ $permanentPlacement->salary }}" required>
                </div>
            </div>

            <div class="col-sm">
                <div class="form-group">
                    <label for="perm_fee">Perm Fee Percentage<span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="perm_fee" name="perm_fee" placeholder="%" value="{{ $permanentPlacement->perm_fee }}" required>
                </div>
                <div class="form-group">
                    <label for="total_fee">Total Fee<span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="total_fee" name="total_fee" placeholder="$" value="{{ $permanentPlacement->total_fee }}" required>
                </div>
                <div class="form-group">
                    <label for="start_date">Start Date<span class="text-danger">*</span></label>
                    <input type="text" id="start_date" name="start_date" class="form-control" placeholder="05/16/1985" value="{{ Carbon\Carbon::parse($permanentPlacement->start_date)->format('m/d/Y') }}" required>
                </div>
                <div class="form-group">
                    <label for="recruiter">Recruiter<span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="recruiter" name="recruiter" placeholder="Recruiter" value="{{ $permanentPlacement->recruiter }}" required>
                </div>
                <div class="form-group">
                    <label for="sales_rep">Sales Rep<span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="sales_rep" name="sales_rep" placeholder="Sales Rep" value="{{ $permanentPlacement->sales_rep }}" required>
                </div>
            </div>

        </div>

        <div class="row">
            <div class="col-sm">
                <div class="form-group">
                    <label for="special_notes">Special Notes</label>
                    <textarea class="form-control" id="special_notes" name="special_notes" rows="6">{{ $permanentPlacement->special_notes }}</textarea>
                </div>
            </div>
        </div>

        <div class="row m-t-20">
            <div class="col-sm text-center">
                <button type="submit" class="btn btn-lg btn-block btn-success">Submit</button>
            </div>
        </div>
    </div>
</form>



@endsection


@section('page-plugins')
<script src="https://cdn.jsdelivr.net/npm/gijgo@1.9.10/js/gijgo.min.js" type="text/javascript"></script>
<script>
    $('#start_date').datepicker();
</script>
@endsection
