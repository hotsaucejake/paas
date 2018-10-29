<section id="wrapper" class="login-register login-sidebar"  style="background-image:url(/monster/together_people.jpg);">

    <div class="login-box card">
        <div class="card-header text-center">{{ __('Verify Your Email Address') }}</div>
        <div class="card-body">
            <img src="/ConvergeTP-Logo-Flat3Color.png" alt="Home" width="100%" height="auto" />

            @if (session('resent'))
                <div class="alert alert-success" role="alert">
                    {{ __('A fresh verification link has been sent to your email address.') }}
                </div>
            @endif

            <p class="text-center m-t-30">{{ __('Before proceeding, please check your email for a verification link.') }}<p>
            <p class="text-center"><strong>{{ __('If you did not receive the email:') }}</strong></p>
            <p class="text-center">
                <a class="btn btn-primary" href="{{ route('verification.resend') }}">{{ __('Request Another') }}</a>
            </p>

        </div>
    </div>
</section>
