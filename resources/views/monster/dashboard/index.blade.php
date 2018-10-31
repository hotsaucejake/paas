@extends('monster.app')

@section('page-title')
PaaS: Dashboard
@endsection


@section('page-css')

@endsection


@section('breadcrumb-title')
Dashboard
@endsection

@section('breadcrumb-nav')
<!-- <li class="breadcrumb-item active">Dashboard</li> -->
@endsection


@section('breadcrumb-buttons')
<!-- <button class="btn pull-right hidden-sm-down btn-success"><i class="mdi mdi-plus-circle"></i> Create</button> -->
@endsection


@section('content')

<div class="row">

    <div class="col-sm">
        <div class="social-widget">
            <div class="soc-header box-facebook">
                <h3 class="text-light">Permanent Placements</h3>
                <i class="fa fa-plus-circle"></i>
            </div>
            <div class="soc-content">
                <div class="col-4 b-r">
                    <h3 class="font-medium">{{ $pp_approved }}</h3>
                    <h5 class="text-muted">Approved</h5>
                </div>
                <div class="col-4 b-r">
                    <h3 class="font-medium">{{ $pp_all - $pp_approved }}</h3>
                    <h5 class="text-muted">Needs Approval</h5>
                </div>
                <div class="col-4">
                    <h3 class="font-medium">{{ $pp_all }}</h3>
                    <h5 class="text-muted">Total</h5>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm">
        <div class="social-widget">
            <div class="soc-header box-twitter">
                <h3 class="text-light">Contractor Requests</h3>
                <i class="fa fa-copy"></i>
            </div>
            <div class="soc-content">
                <div class="col-4 b-r">
                    <h3 class="font-medium">{{ $cb_approved }}</h3>
                    <h5 class="text-muted">Approved</h5>
                </div>
                <div class="col-4 b-r">
                    <h3 class="font-medium">{{ $cb_all - $cb_approved }}</h3>
                    <h5 class="text-muted">Needs Approval</h5>
                </div>
                <div class="col-4">
                    <h3 class="font-medium">{{ $cb_all }}</h3>
                    <h5 class="text-muted">Total</h5>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection


@section('page-plugins')

@endsection
