@extends('monster.app')


@section('page-title')
PaaS: Distribution Emails
@endsection


@section('page-css')
<link href="/monster/assets/plugins/multiselect/css/multi-select.css" rel="stylesheet" type="text/css" />
@endsection


@section('breadcrumb-title')
Distribution Email: Create
@endsection


@section('breadcrumb-nav')
<li class="breadcrumb-item"><a href="{{ route('distribution_email.index') }}">Distribution Emails</a></li>
<li class="breadcrumb-item active">Create</li>
@endsection


@section('content')

<div class="row">
    <div class="col-lg-12">
        <div class="card card-outline-primary">
            <div class="card-header">
                <h4 class="m-b-0 text-white">Create New Distribution Email</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('distribution_email.store') }}" method="POST">
                    @csrf
                    <div class="form-body">
                        <div class="row p-t-20">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Email<span class="text-danger">*</span></label>
                                    <input type="email" name="email" class="form-control" placeholder="email@email.com" value="{{ old('email') }}" required>
                                    <!-- <small class="form-control-feedback"> This is inline help </small> -->
                                </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Distribution Lists (optional)</label>
                                    <select multiple id="public-methods" name="distribution_lists[]">
                                        @foreach ($lists as $list)
                                            <option value="{{ $list->id }}">{{ $list->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-12 p-t-30">
                                <div class="form-group pull-right">
                                        <button type="submit" class="btn btn-primary btn-lg"> <i class="fa fa-check"></i> Submit</button>
                                </div>
                            </div>
                        </div>
                        <!--/row-->
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

@endsection


@section('page-plugins')
<script type="text/javascript" src="/monster/assets/plugins/multiselect/js/jquery.multi-select.js"></script>
<script>
    jQuery(document).ready(function() {
        $('#public-methods').multiSelect();
    });
</script>
@endsection