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

            <form class="form-horizontal form-material" role="form" method="POST" action="{{ route('login') }}" id="loginform">
                @csrf

                <div class="form-group m-t-40">
                    <div class="col-xs-12">
                        <input type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="Email" name="email" value="{{ old('email') }}" autofocus required>

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

                        @if ($errors->has('email'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group text-center m-t-20">
                    <div class="col-xs-12">
                    <button class="btn btn-primary btn-lg btn-block text-uppercase waves-effect waves-light" type="submit">Login</button>
                    </div>
                </div>

            </form>


            <div class="form-group m-t-30 p-t-30">
                <div class="col-sm-12 text-center p-t-30">
                <p class="p-t-30">Forgot your password?  Rather login without a password?  Don't have an account?</p>
                <p><a href="{{ route('password.request') }}" class="btn btn-warning btn-block waves-effect waves-light">Request Password Reset</a></p>
                <p><a href="{{ route('passwordless') }}" class="btn btn-info btn-block waves-effect waves-light">Passwordless Login</a></p>
                <p><a href="{{ route('register') }}" class="btn btn-danger btn-block waves-effect waves-light">Register</a></p>
                </div>
            </div>


        </div>
    </div>
</section>
