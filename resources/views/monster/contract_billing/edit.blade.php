@extends('monster.app')


@section('page-title')
PaaS: Contract Billings
@endsection


@section('page-css')
<link href="https://cdn.jsdelivr.net/npm/gijgo@1.9.10/css/gijgo.min.css" rel="stylesheet" type="text/css" />
@endsection


@section('breadcrumb-title')
Contract Billing: Edit
@endsection


@section('breadcrumb-nav')
<li class="breadcrumb-item"><a href="{{ route('contract_billing.index') }}">Contract Billings</a></li>
<li class="breadcrumb-item active">Edit</li>
@endsection


@section('breadcrumb-buttons')

@endsection


@section('content')

<form method="POST" action="{{ route('contract_billing.update', ['contract_billing' => $contractBilling->id]) }}">
    @csrf
    @method('PATCH')
    <div class="container">
        <div class="jumbotron">
            <h1 class="text-center">New Contractor Request</h1>
            <p class="lead text-center">Please prepare the new hire paperwork for review ASAP</p>
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
                            <option value="{{ $convergeCompany->id }}" {{ $contractBilling->converge_company_id == $convergeCompany->id ? 'selected' : '' }}>{{ $convergeCompany->title }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col-md-4">

            </div>
        </div>

        <h3 class="text-center">Candidate Info</h3>

        <div class="row">

            <div class="col-sm">
                <div class="form-group">
                    <label for="first_name">First Name<span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="first_name" name="first_name" placeholder="First" value="{{ $contractBilling->first_name }}" required>
                </div>
            </div>

            <div class="col-sm">
                <div class="form-group">
                    <label for="mi">MI</label>
                    <input type="text" class="form-control" id="mi" name="mi" placeholder="MI" value="{{ $contractBilling->mi }}">
                </div>
            </div>

            <div class="col-sm">
                <div class="form-group">
                    <label for="last_name">Last Name<span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Last" value="{{ $contractBilling->last_name }}" required>
                </div>
            </div>

        </div>

        <div class="row">

            <div class="col-sm">
                <div class="form-group">
                    <label for="consultant_company">Consultant Company Name</label>
                    <input type="text" class="form-control" id="consultant_company" name="consultant_company" placeholder="(Corp to Corp)" value="{{ $contractBilling->consultant_company }}">
                </div>

                <div class="form-group">
                    <label for="phone">Phone<span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="phone" name="phone" placeholder="555-555-5555" value="{{ $contractBilling->phone }}" required>
                </div>

                <div class="form-group">
                    <label for="email">Email<span class="text-danger">*</span></label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Email" value="{{ $contractBilling->email }}" required>
                </div>
            </div>

            <div class="col-sm">
                <div class="form-group">
                    <label for="address">Address<span class="text-danger">*</span></label>
                    <textarea class="form-control" id="address" name="address" rows="6" required>{{ $contractBilling->address }}</textarea>
                </div>
            </div>

        </div>

        <hr/>

        <h3 class="text-center">Position Details</h3>
        <div class="row">

            <div class="col-sm">
                <div class="form-group">
                    <label for="client_name">Company/Client Name<span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="client_name" name="client_name" placeholder="Name" value="{{ $contractBilling->client_name }}" required>
                </div>

                <div class="form-group">
                    <label for="job_title">Job Title<span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="job_title" name="job_title" placeholder="Title" value="{{ $contractBilling->job_title }}" required>
                </div>

                <div class="form-group">
                    <label for="job_location">Job Location Address<span class="text-danger">*</span></label>
                    <textarea class="form-control" id="job_location" name="job_location" rows="6" required>{{ $contractBilling->job_location }}</textarea>
                </div>

                <div class="form-group">
                    <label for="contract_rate">Contract Rate<span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="contract_rate" name="contract_rate" placeholder="$" value="{{ $contractBilling->contract_rate }}" required>
                </div>

                <div class="form-group">
                    <label for="bill_rate">Bill Rate<span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="bill_rate" name="bill_rate" placeholder="$" value="{{ $contractBilling->bill_rate }}" required>
                </div>

                <div class="form-group">
                    <legend style="font-weight:400;font-size:1rem;">Overtime Eligible at a Rate of Time and a Half?<span class="text-danger">*</span></legend>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="overtime_eligible" id="overtime_eligible1" value="1" {{ $contractBilling->overtime_eligible == "1" ? 'checked' : '' }} required>
                        <label class="form-check-label" for="overtime_eligible1">Yes</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="overtime_eligible" id="overtime_eligible2" value="0" {{ $contractBilling->overtime_eligible == "0" ? 'checked' : '' }} required>
                        <label class="form-check-label" for="overtime_eligible2">No</label>
                    </div>
                </div>

                <div class="form-group">
                    <label for="base_salary">Base Salary</label>
                    <input type="text" class="form-control" id="base_salary" name="base_salary" placeholder="$" value="{{ $contractBilling->base_salary }}">
                </div>

                <div class="form-group">
                    <label for="start_date">Start Date<span class="text-danger">*</span></label>
                    <input type="text" id="start_date" name="start_date" class="form-control" placeholder="05/16/1985" value="{{ Carbon\Carbon::parse($contractBilling->start_date)->format('m/d/Y') }}" required>
                </div>

                <div class="form-group">
                    <label for="estimated_end_date">Estimated End Date</label>
                    <input type="text" id="estimated_end_date" name="estimated_end_date" class="form-control" placeholder="05/16/1985" value="{{ $contractBilling->estimated_end_date ? Carbon\Carbon::parse($contractBilling->estimated_end_date)->format('m/d/Y') : '' }}">
                </div>

                <div class="form-group">
                    <label for="contract_period">Contract Length<span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="contract_period" name="contract_period" placeholder="6 mo." value="{{ $contractBilling->contract_period }}" required>
                </div>
            </div>

            <div class="col-sm">
                <div class="form-group">
                    <legend style="font-weight:400;font-size:1rem;">Environment<span class="text-danger">*</span></legend>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="environment" id="environment1" value="onsite" {{ $contractBilling->environment == 'onsite' ? 'checked' : '' }} required>
                        <label class="form-check-label" for="environment1">Onsite</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="environment" id="environment2" value="remote" {{ $contractBilling->environment == 'remote' ? 'checked' : '' }} required>
                        <label class="form-check-label" for="environment2">Remote</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="environment" id="environment3" value="both" {{ $contractBilling->environment == 'both' ? 'checked' : '' }} required>
                        <label class="form-check-label" for="environment3">Both</label>
                    </div>
                </div>

                <div class="form-group">
                    <legend style="font-weight:400;font-size:1rem;">Hire Type<span class="text-danger">*</span></legend>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="hire_type" id="hire_type1" value="w2" {{ $contractBilling->hire_type == 'w2' ? 'checked' : '' }} required>
                        <label class="form-check-label" for="hire_type1">W2</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="hire_type" id="hire_type2" value="1099" {{ $contractBilling->hire_type == '1099' ? 'checked' : '' }} required>
                        <label class="form-check-label" for="hire_type2">1099</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="hire_type" id="hire_type3" value="corp to corp" {{ $contractBilling->hire_type == 'corp to corp' ? 'checked' : '' }} required>
                        <label class="form-check-label" for="hire_type3">Corp to Corp</label>
                    </div>
                </div>

                <div class="form-group">
                    <legend style="font-weight:400;font-size:1rem;">Project Type<span class="text-danger">*</span></legend>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="project_type" id="project_type1" value="aug" {{ $contractBilling->project_type == 'aug' ? 'checked' : '' }} required>
                        <label class="form-check-label" for="project_type1">Staff Augmentation</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="project_type" id="project_type2" value="sow" {{ $contractBilling->project_type == 'sow' ? 'checked' : '' }} required>
                        <label class="form-check-label" for="project_type2">SOW</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="project_type" id="project_type3" value="pse" {{ $contractBilling->project_type == 'pse' ? 'checked' : '' }} required>
                        <label class="form-check-label" for="project_type3">Professional Services Engagement</label>
                    </div>
                </div>

                <div class="form-group">
                    <label for="client_name">SOW<span class="text-danger"></span></label>
                    <input type="text" class="form-control" id="sow" name="sow" placeholder="(If Project Type is SOW)" value="{{ $contractBilling->sow }}">
                </div>

                <div class="form-group">
                    <legend style="font-weight:400;font-size:1rem;">Issued Hardware<span class="text-danger">*</span></legend>
                    <select class="custom-select" name="issued_hardware" style="max-width: 100%" required>
                        <option value="None" {{ $contractBilling->issued_hardware == 'None' || $contractBilling->issued_hardware == 'none' ? 'selected' : '' }}>None</option>
                        <option value="Client" {{ $contractBilling->issued_hardware == 'Client' || $contractBilling->issued_hardware == 'client' ? 'selected' : '' }}>Client</option>
                        <optgroup label="Converge Companies">
                            @foreach ($convergeCompanies as $convergeCompany)
                                <option value="{{ $convergeCompany->title }}" {{ $contractBilling->issued_hardware == $convergeCompany->title ? 'selected' : '' }}>{{ $convergeCompany->title }}</option>
                            @endforeach
                        </optgroup>
                        
                    </select>
                </div>

                <div class="form-group">
                    <legend style="font-weight:400;font-size:1rem;">We Provide Email?<span class="text-danger">*</span></legend>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="corus_email" id="corus_email1" value="1" {{ $contractBilling->corus_email == "1" ? 'checked' : '' }} required>
                        <label class="form-check-label" for="corus_email1">Yes</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="corus_email" id="corus_email2" value="0" {{ $contractBilling->corus_email == "0" ? 'checked' : '' }} required>
                        <label class="form-check-label" for="corus_email2">No</label>
                    </div>
                </div>

                <div class="form-group">
                    <legend style="font-weight:400;font-size:1rem;">Background Check<span class="text-danger">*</span></legend>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="background_check" id="background_check1" value="yes" {{ $contractBilling->background_check == 'yes' ? 'checked' : '' }} required>
                        <label class="form-check-label" for="background_check1">Yes</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="background_check" id="background_check2" value="no" {{ $contractBilling->background_check == 'no' ? 'checked' : '' }} required>
                        <label class="form-check-label" for="background_check2">No</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="background_check" id="background_check3" value="completed" {{ $contractBilling->background_check == 'completed' ? 'checked' : '' }} required>
                        <label class="form-check-label" for="background_check3">Completed</label>
                    </div>
                </div>

                <div class="form-group">
                    <legend style="font-weight:400;font-size:1rem;">Traveling, expense reporting?<span class="text-danger">*</span></legend>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="travel_reporting" id="travel_reporting1" value="1" {{ $contractBilling->travel_reporting == "1" ? 'checked' : '' }} required>
                        <label class="form-check-label" for="travel_reporting1">Yes</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="travel_reporting" id="travel_reporting2" value="0" {{ $contractBilling->travel_reporting == "0" ? 'checked' : '' }} required>
                        <label class="form-check-label" for="travel_reporting2">No</label>
                    </div>
                </div>

                <div class="form-group">
                    <legend style="font-weight:400;font-size:1rem;">Issued Concur?<span class="text-danger">*</span></legend>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="concur" id="concur1" value="1" {{ $contractBilling->concur == "1" ? 'checked' : '' }} required>
                        <label class="form-check-label" for="concur1">Yes</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="concur" id="concur2" value="0" {{ $contractBilling->concur == "0" ? 'checked' : '' }} required>
                        <label class="form-check-label" for="concur2">No</label>
                    </div>
                </div>

                <div class="form-group">
                    <label for="drug_test">Drug Test?<span class="text-danger">*</span></label>
                    <select class="form-control" id="drug_test" name="drug_test" required>
                        <option value="no" {{ $contractBilling->drug_test == 'no' ? 'selected' : '' }}>No</option>
                        <option value="p5" {{ $contractBilling->drug_test == 'p5' ? 'selected' : '' }}>Panel 5</option>
                        <option value="p9" {{ $contractBilling->drug_test == 'p9' ? 'selected' : '' }}>Panel 9</option>
                        <option value="p10" {{ $contractBilling->drug_test == 'p10' ? 'selected' : '' }}>Panel 10</option>
                        <option value="p11" {{ $contractBilling->drug_test == 'p11' ? 'selected' : '' }}>Panel 11</option>
                        <option value="other" {{ $contractBilling->drug_test == 'other' ? 'selected' : '' }}>Other</option>
                    </select>
                </div>

                <div class="form-group">
                    <legend style="font-weight:400;font-size:1rem;">Benefits?<span class="text-danger">*</span></legend>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="benefits" id="benefits1" value="1" {{ $contractBilling->benefits == "1" ? 'checked' : '' }} required>
                        <label class="form-check-label" for="benefits1">Yes</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="benefits" id="benefits2" value="0" {{ $contractBilling->benefits == "0" ? 'checked' : '' }} required>
                        <label class="form-check-label" for="benefits2">No</label>
                    </div>
                </div>
            </div>

        </div>

        <hr/>

        <div class="row">

            <div class="col-sm">
                <div class="form-group">
                    <label for="client_contact">Client Contact<span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="client_contact" name="client_contact" placeholder="Name" value="{{ $contractBilling->client_contact }}" required>
                </div>

                <div class="form-group">
                    <label for="manager">Hiring Manager / Timesheet Approver<span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="manager" name="manager" placeholder="Name" value="{{ $contractBilling->manager }}" required>
                </div>

                <div class="form-group">
                    <label for="manager_email">Hiring Manager / Timesheet Approver Email<span class="text-danger">*</span></label>
                    <input type="email" class="form-control" id="manager_email" name="manager_email" placeholder="Email" value="{{ $contractBilling->manager_email }}" required>
                </div>

                <div class="form-group">
                    <label for="paycom_id">Paycom ID</label>
                    <input type="text" class="form-control" id="paycom_id" name="paycom_id" placeholder="ID" value="{{ $contractBilling->paycom_id }}">
                </div>

            </div>

            <div class="col-sm">
                <div class="form-group">
                    <label for="manager_phone">Hiring Manager / Timesheet Approver Phone</label>
                    <input type="text" class="form-control" id="manager_phone" name="manager_phone" placeholder="555-555-5555" value="{{ $contractBilling->manager_phone }}">
                </div>

                <div class="form-group">
                    <label for="recruiter">Recruiter(s)<span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="recruiter" name="recruiter" placeholder="Recruiter(s)" value="{{ $contractBilling->recruiter }}" required>
                </div>

                <div class="form-group">
                    <label for="account_manager">Account Manager<span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="account_manager" name="account_manager" placeholder="(include split information)" value="{{ $contractBilling->account_manager }}" required>
                </div>
            </div>

        </div>

        <div class="row">
            <div class="col-sm">
                <div class="form-group">
                    <label for="notes">Notes per AM or Client Request:</label>
                    <textarea class="form-control" id="notes" name="notes" rows="6">{{ $contractBilling->notes }}</textarea>
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
    $('#estimated_end_date').datepicker();
</script>
@endsection
