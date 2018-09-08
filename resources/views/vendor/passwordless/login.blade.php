<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" sizes="16x16" href="/favicon.ico">
    <title>PaaS Login | Corus360</title>
    <!-- Bootstrap Core CSS -->
    <link href="/monster/assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="/monster/css/style.css" rel="stylesheet">
    <!-- You can change the theme colors from here -->
    <link href="/monster/css/colors/green.css" id="theme" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>

<body>
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" /> </svg>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <section id="wrapper" class="login-register login-sidebar"  style="background-image:url(/monster/together_people.jpg);">

        <div class="login-box card">
            <div class="card-body">
                <img src="/CORUS360-CONVERGE.png" alt="Home" width="100%" height="auto" />

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

                <form class="form-horizontal form-material" role="form" method="POST" action="{{ route('passwordless.login') }}" id="loginform">
                        {{ csrf_field() }}
                
                
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
                
                <div class="form-group text-center m-t-20">
                    <div class="col-xs-12">
                    <button class="btn btn-info btn-lg btn-block text-uppercase waves-effect waves-light" type="submit">Send Sign-In Link</button>
                    </div>
                </div>
                <div class="form-group m-b-0">
                    <div class="col-sm-12 text-center">
                    <p>Don't have an account? <a href="/register" class="text-primary m-l-5"><b>Register</b></a></p>
                    </div>
                </div>
                </form>
                <form class="form-horizontal" id="recoverform" action="index.html">
                <div class="form-group ">
                    <div class="col-xs-12">
                    <h3>Recover Password</h3>
                    <p class="text-muted">Enter your Email and instructions will be sent to you! </p>
                    </div>
                </div>
                <div class="form-group ">
                    <div class="col-xs-12">
                    <input class="form-control" type="text" required="" placeholder="Email">
                    </div>
                </div>
                <div class="form-group text-center m-t-20">
                    <div class="col-xs-12">
                    <button class="btn btn-primary btn-lg btn-block text-uppercase waves-effect waves-light" type="submit">Reset</button>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </section>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="/monster/assets/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="/monster/assets/plugins/bootstrap/js/popper.min.js"></script>
    <script src="/monster/assets/plugins/bootstrap/js/bootstrap.min.js"></script>
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="/monster/js/jquery.slimscroll.js"></script>
    <!--Wave Effects -->
    <script src="/monster/js/waves.js"></script>
    <!--Menu sidebar -->
    <script src="/monster/js/sidebarmenu.js"></script>
    <!--stickey kit -->
    <script src="/monster/assets/plugins/sticky-kit-master/dist/sticky-kit.min.js"></script>
    <!--Custom JavaScript -->
    <script src="/monster/js/custom.min.js"></script>
    <!-- ============================================================== -->
    <!-- Style switcher -->
    <!-- ============================================================== -->
    <script src="/monster/assets/plugins/styleswitcher/jQuery.style.switcher.js"></script>
</body>

</html>