@extends('monster.app')


@section('page-title')
PaaS: Permissions
@endsection


@section('page-css')
<link href="/monster/assets/plugins/multiselect/css/multi-select.css" rel="stylesheet" type="text/css" />
@endsection


@section('breadcrumb-title')
Permission: Create
@endsection


@section('breadcrumb-nav')
<li class="breadcrumb-item"><a href="{{ route('permission.index') }}">Permissions</a></li>
<li class="breadcrumb-item active">Create</li>
@endsection


@section('content')

<div class="row">
    <div class="col-lg-12">
        <div class="card card-outline-primary">
            <div class="card-header">
                <h4 class="m-b-0 text-white">Create New Permission</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('permission.store') }}" method="POST">
                    @csrf
                    <div class="form-body">
                        <div class="row p-t-20">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">Name*</label>
                                    <input type="text" name="name" class="form-control" placeholder="edit_users" value="{{ old('name') }}" required>
                                    <!-- <small class="form-control-feedback"> This is inline help </small> -->
                                </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">Guard (optional)</label>
                                    <input type="text" name="guard_name" class="form-control" placeholder="web" value="{{ old('guard_name') }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">Roles (optional)</label>
                                    <select multiple id="public-methods" name="roles[]">
                                        @foreach ($roles as $role)
                                            <option value="{{ $role->id }}">{{ $role->name }}</option>
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