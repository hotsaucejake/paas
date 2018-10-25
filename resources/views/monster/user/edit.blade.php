@extends('monster.app')


@section('page-title')
PaaS: Users
@endsection


@section('page-css')
<link href="/monster/assets/plugins/multiselect/css/multi-select.css" rel="stylesheet" type="text/css" />
@endsection


@section('breadcrumb-title')
User: Edit
@endsection


@section('breadcrumb-nav')
<li class="breadcrumb-item"><a href="{{ route('user.index') }}">Users</a></li>
<li class="breadcrumb-item active">Edit</li>
@endsection


@section('content')

<div class="row">
    <div class="col-lg-12">
        <div class="card card-outline-primary">
            <div class="card-header">
                <h4 class="m-b-0 text-white">Edit User</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('user.update', ['user' => $user->id]) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <div class="form-body">
                        <div class="row p-t-20">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Name<span class="text-danger">*</span></label>
                                    <input type="text" name="name" class="form-control" placeholder="John Doe" value="{{ $user->name }}" required />
                                    <!-- <small class="form-control-feedback"> This is inline help </small> -->
                                </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Email<span class="text-danger">*</span></label>
                                    <input type="email" name="email" class="form-control" placeholder="jdoe@mtparanschool.com" value="{{ $user->email }}" disabled />
                                </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="password" class="form-check-label">Password<span class="text-danger">*</span></label><br>
                                    <input type="password" id="password" name="password" class="form-control" minlength="6" />
                                </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="password" class="form-check-label">Confirm Password<span class="text-danger">*</span></label><br>
                                    <input type="password" name="password_confirmation" class="form-control" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">User Roles</label>
                                    <select multiple id="public-methods" name="roles[]">
                                        @foreach ($roles as $role)
                                            <option value="{{ $role->name }}"
                                                @foreach ($user->getRoleNames() as $userRole)
                                                    {{ $userRole === $role->name ? 'selected' : '' }}
                                                @endforeach
                                                >{{ $role->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <!--/row-->
                        <div class="row p-t-20">

                            <div class="col-md-4">
                                <div>
                                    <button type="submit" class="btn btn-primary btn-lg"> <i class="fa fa-check"></i> Submit</button>
                                </div>
                            </div>
                            <!--/span-->
                        </div>
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