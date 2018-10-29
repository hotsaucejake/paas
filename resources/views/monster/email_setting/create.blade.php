@extends('monster.app')


@section('page-title')
PaaS: Email Settings
@endsection


@section('page-css')

@endsection


@section('breadcrumb-title')
Email Setting: Create
@endsection


@section('breadcrumb-nav')
<li class="breadcrumb-item"><a href="{{ route('email_setting.index') }}">Email Settings</a></li>
<li class="breadcrumb-item active">Create</li>
@endsection


@section('breadcrumb-buttons')

@endsection


@section('content')

<form method="POST" action="{{ route('email_setting.store') }}">
    @csrf
    <div class="container">

        <div class="row">

            <div class="col-sm">
                <div class="form-group">
                    <label for="driver">Driver<span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="driver" name="driver" placeholder="smtp, sendmail, mailgun, mandrill, ses, sparkpost, log, array" value="{{ old('driver') }}" required>
                </div>

                <div class="form-group">
                    <label for="host">Host<span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="host" name="host" placeholder="smtp.mailtrap.io" value="{{ old('host') }}" required>
                </div>

                <div class="form-group">
                    <label for="port">Port<span class="text-danger">*</span></label>
                    <input type="number" class="form-control" id="port" name="port" placeholder="2525" value="{{ old('port') }}" required>
                </div>

                <div class="form-group">
                    <label for="encryption">Encryption</label>
                    <input type="text" class="form-control" id="encryption" name="encryption" placeholder="tls" value="{{ old('encryption') }}">
                </div>
            </div>

            <div class="col-sm">
                <div class="form-group">
                    <label for="from_address">From Address<span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="from_address" name="from_address" placeholder="info@people-as-a-service.com" value="{{ old('from_address') }}" required>
                </div>

                <div class="form-group">
                    <label for="from_name">From Name<span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="from_name" name="from_name" placeholder="PaaS" value="{{ old('from_name') }}" required>
                </div>

                <div class="form-group">
                    <label for="username">Username<span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="username" name="username" placeholder="info" value="{{ old('username') }}" required>
                </div>

                <div class="form-group">
                    <label for="password">Password<span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="password" name="password" placeholder="******" value="{{ old('password') }}" required>
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

@endsection
