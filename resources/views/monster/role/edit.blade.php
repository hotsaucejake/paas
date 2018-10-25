@extends('monster.app')


@section('page-title')
PaaS: Roles
@endsection


@section('page-css')
<link href="/monster/assets/plugins/multiselect/css/multi-select.css" rel="stylesheet" type="text/css" />
@endsection


@section('breadcrumb-title')
Role: Edit
@endsection


@section('breadcrumb-nav')
<li class="breadcrumb-item"><a href="{{ route('role.index') }}">Roles</a></li>
<li class="breadcrumb-item active">Edit</li>
@endsection


@section('content')

<div class="row">
    <div class="col-lg-12">
        <div class="card card-outline-primary">
            <div class="card-header">
                <h4 class="m-b-0 text-white">Edit Role</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('role.update', ['role' => $role->id]) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <div class="form-body">
                        <div class="row p-t-20">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">Name*</label>
                                    <input type="text" name="name" class="form-control" placeholder="super-admin" value="{{ $role->name }}" required>
                                    <!-- <small class="form-control-feedback"> This is inline help </small> -->
                                </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">Guard (optional)</label>
                                    <input type="text" name="guard_name" class="form-control" placeholder="web" value="{{ $role->guard_name }}" disabled>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">Permissions (optional)</label>
                                    <select multiple id="public-methods" name="permissions[]">
                                        @foreach ($permissions as $permission)
                                            <option value="{{ $permission->id }}"
                                                @foreach($role->permissions as $rolePermission)
                                                    {{ $rolePermission->id === $permission->id ? 'selected' : '' }}
                                                @endforeach
                                                >{{ $permission->name }}
                                            </option>
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