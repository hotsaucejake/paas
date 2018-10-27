@extends('monster.app')


@section('page-title')
PaaS: Contract Billings
@endsection


@section('page-css')

@endsection


@section('breadcrumb-title')
Contract Billing: Create
@endsection


@section('breadcrumb-nav')
<li class="breadcrumb-item"><a href="{{ route('contract_billing.index') }}">Contract Billings</a></li>
<li class="breadcrumb-item active">View</li>
@endsection


@section('breadcrumb-buttons')
@if(auth()->user()->hasPermissionTo('add_contract_billings'))<a class="btn pull-right btn-success" href="{{ route('contract_billing.create') }}"><i class="mdi mdi-plus-circle"></i> Create</a>@endif
@endsection


@section('content')

<div class="container">
    <div class="jumbotron">
        <h1 class="text-center">New Contractor Request</h1>
        <p class="text-center">Form #{{ $contractBilling->id }} created by <strong>{{ $contractBilling->user->name }}</strong> on {{ $contractBilling->created_at->toDateString() }}</p>
    </div>

    <h3 class="text-center">Candidate Info</h3>

    <div class="row">

        <div class="col-sm">
            <div class="form-group">
                <label for="first_name">First Name</label>
                <p class="lead font-weight-bold">{{ $contractBilling->first_name }}</p>
            </div>
        </div>

        <div class="col-sm">
            <div class="form-group">
                <label for="mi">MI</label>
                <p class="lead font-weight-bold">{{ $contractBilling->mi }}</p>
            </div>
        </div>

        <div class="col-sm">
            <div class="form-group">
                <label for="last_name">Last Name</label>
                <p class="lead font-weight-bold">{{ $contractBilling->last_name }}</p>
            </div>
        </div>

    </div>

    <div class="row">

        <div class="col-sm">
            <div class="form-group">
                <label for="consultant_company">Consultant Company Name</label>
                <p class="lead font-weight-bold">{{ $contractBilling->consultant_company }}</p>
            </div>

            <div class="form-group">
                <label for="phone">Phone</label>
                <p class="lead font-weight-bold">{{ $contractBilling->phone }}</p>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <p class="lead font-weight-bold">{{ $contractBilling->email }}</p>
            </div>
        </div>

        <div class="col-sm">
            <div class="form-group">
                <label for="address">Address</label>
                <p class="lead font-weight-bold">{!! nl2br($contractBilling->address) !!}</p>
            </div>
        </div>

    </div>

    <hr/>

    <h3 class="text-center">Position Details</h3>
    <div class="row">

        <div class="col-sm">
            <div class="form-group">
                <label for="client_name">Company/Client Name</label>
                <p class="lead font-weight-bold">{{ $contractBilling->client_name }}</p>
            </div>

            <div class="form-group">
                <label for="job_title">Job Title</label>
                <p class="lead font-weight-bold">{{ $contractBilling->job_title }}</p>
            </div>

            <div class="form-group">
                <label for="job_location">Job Location Address</label>
                <p class="lead font-weight-bold">{!! nl2br($contractBilling->job_location) !!}</p>
            </div>

            <div class="form-group">
                <label for="contract_rate">Contract Rate</label>
                <p class="lead font-weight-bold">{{ $contractBilling->contract_rate }}</p>
            </div>

            <div class="form-group">
                <label for="bill_rate">Bill Rate</label>
                <p class="lead font-weight-bold">{{ $contractBilling->bill_rate }}</p>
            </div>

            <div class="form-group">
                <label for="base_salary">Base Salary</label>
                <p class="lead font-weight-bold">{{ $contractBilling->base_salary }}</p>
            </div>

            <div class="form-group">
                <label for="start_date">Start Date</label>
                <p class="lead font-weight-bold">{{ $contractBilling->start_date }}</p>
            </div>

            <div class="form-group">
                <label for="contract_period">Contract Period</label>
                <p class="lead font-weight-bold">{{ $contractBilling->contract_period }}</p>
            </div>
        </div>

        <div class="col-sm">
            <div class="form-group">
                <legend style="font-weight:400;font-size:1rem;">Environment</legend>
                <p class="lead font-weight-bold">{{ ucwords($contractBilling->environment) }}</p>
            </div>

            <div class="form-group">
                <legend style="font-weight:400;font-size:1rem;">Hire Type</legend>
                <p class="lead font-weight-bold">{{ ucwords($contractBilling->hire_type) }}</p>
            </div>

            <div class="form-group">
                <legend style="font-weight:400;font-size:1rem;">Project Type</legend>
                <p class="lead font-weight-bold">
                    @if($contractBilling->project_type == 'aug')
                        Staff Augmentation
                    @elseif($contractBilling->project_type == 'sow')
                        SOW
                    @endif
                </p>
            </div>

            <div class="form-group">
                <legend style="font-weight:400;font-size:1rem;">Issued Hardware</legend>
                <p class="lead font-weight-bold">
                    @if($contractBilling->issued_hardware)
                        Yes
                    @else 
                        No
                    @endif
                </p>
            </div>

            <div class="form-group">
                <legend style="font-weight:400;font-size:1rem;">We Provide Email?</legend>
                <p class="lead font-weight-bold">
                        @if($contractBilling->corus_email)
                            Yes
                        @else 
                            No
                        @endif
                    </p>
            </div>

            <div class="form-group">
                <legend style="font-weight:400;font-size:1rem;">Background Check</legend>
                <p class="lead font-weight-bold">{{ ucwords($contractBilling->background_check) }}</p>
            </div>

            <div class="form-group">
                <legend style="font-weight:400;font-size:1rem;">Traveling, expense reporting?</legend>
                <p class="lead font-weight-bold">
                        @if($contractBilling->travel_reporting)
                            Yes
                        @else 
                            No
                        @endif
                    </p>
            </div>

            <div class="form-group">
                <label for="drug_test">Drug Test?</label>
                <p class="lead font-weight-bold">
                    @if($contractBilling->drug_test == 'no')
                        No
                    @elseif($contractBilling->drug_test == 'p5')
                        Panel 5
                    @elseif($contractBilling->drug_test == 'p9')
                        Panel 9
                    @elseif($contractBilling->drug_test == 'p10')
                        Panel 10
                    @elseif($contractBilling->drug_test == 'p11')
                        Panel 11
                    @elseif($contractBilling->drug_test == 'other')
                        Other
                    @endif
                </p>
            </div>

            <div class="form-group">
                <legend style="font-weight:400;font-size:1rem;">Benefits?</legend>
                <p class="lead font-weight-bold">
                        @if($contractBilling->benefits)
                            Yes
                        @else 
                            No
                        @endif
                    </p>
            </div>
        </div>

    </div>

    <hr/>

    <div class="row">

        <div class="col-sm">
            <div class="form-group">
                <label for="client_contact">Client Contact</label>
                <p class="lead font-weight-bold">{{ $contractBilling->client_contact }}</p>
            </div>

            <div class="form-group">
                <label for="manager">Hiring Manager / Timesheet Approver</label>
                <p class="lead font-weight-bold">{{ $contractBilling->manager }}</p>
            </div>

            <div class="form-group">
                <label for="manager_email">Hiring Manager / Timesheet Approver Email</label>
                <p class="lead font-weight-bold">{{ $contractBilling->manager_email }}</p>
            </div>

        </div>

        <div class="col-sm">
            <div class="form-group">
                <label for="manager_phone">Hiring Manager / Timesheet Approver Phone</label>
                <p class="lead font-weight-bold">{{ $contractBilling->manager_phone }}</p>
            </div>

            <div class="form-group">
                <label for="recruiter">Recruiter(s)</label>
                <p class="lead font-weight-bold">{{ $contractBilling->recruiter }}</p>
            </div>

            <div class="form-group">
                <label for="account_manager">Account Manager</label>
                <p class="lead font-weight-bold">{{ $contractBilling->account_manager }}</p>
            </div>
        </div>

    </div>

    <div class="row">
        <div class="col-sm">
            <div class="form-group">
                <label for="notes">Notes per AM or Client Request:</label>
                <p class="lead font-weight-bold">{!! nl2br($contractBilling->notes) !!}</p>
            </div>
        </div>
    </div>

</div>



@endsection


@section('page-plugins')

@endsection
