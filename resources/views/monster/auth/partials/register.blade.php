<section id="wrapper" class="login-register login-sidebar"  style="background-image:url(/monster/together_people.jpg);">

    <div class="login-box card">
        <div class="card-body">
            <img src="/ConvergeTP-Logo-Flat3Color.png" alt="Home" width="100%" height="auto" />

            @if (count($errors) > 0)
                <div class="alert alert-danger m-t-40">
                    <strong>Whoops!</strong> Something went wrong!
                    <br><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if (session('status'))
                <div class="alert alert-success m-t-40">
                    {{ session('status') }}
                </div>
            @endif

            <form class="form-horizontal form-material" role="form" method="POST" action="{{ route('register') }}" id="loginform">
                @csrf

                <div class="form-group m-t-40">
                    <div class="col-xs-12">
                        <input type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="Name" name="name" value="{{ old('name') }}" autofocus required>

                        @if ($errors->has('name'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group m-t-40">
                    <div class="col-xs-12">
                        <input type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="Email" name="email" value="{{ old('email') }}" required>

                        @if ($errors->has('email'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group m-t-40">
                    <div class="col-xs-12">
                        <input type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="Password" name="password" required>

                        @if ($errors->has('password'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group m-t-40">
                    <div class="col-xs-12">
                        <input type="password" class="form-control" placeholder="Confirm Password" name="password_confirmation" required>
                    </div>
                </div>

                <div class="form-group text-center m-t-20">
                    <div class="col-xs-12">
                    <button class="btn btn-primary btn-lg btn-block text-uppercase waves-effect waves-light" type="submit">Register</button>
                    </div>
                </div>

            </form>
        </div>
    </div>
</section>
