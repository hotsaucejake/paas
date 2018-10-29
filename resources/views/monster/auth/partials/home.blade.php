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


            <div class="form-group m-t-30 p-t-30">
                @if (Route::has('login'))
                    <div class="top-right links">
                        @auth
                            <a href="{{ url('/dashboard') }}">Dashboard</a>
                        @else
                            <p><a href="{{ route('login') }}" class="btn btn-primary btn-block waves-effect waves-light">Login With Password</a></p>
                            <p><a href="{{ route('passwordless') }}" class="btn btn-info btn-block waves-effect waves-light">Passwordless Login</a></p>
                            <p><a href="{{ route('password.request') }}" class="btn btn-warning btn-block waves-effect waves-light">Reset Password</a></p>
                            <p><a href="{{ route('register') }}" class="btn btn-danger btn-block waves-effect waves-light">Register</a></p>
                        @endauth
                    </div>
                @endif
            </div>


        </div>
    </div>
</section>
