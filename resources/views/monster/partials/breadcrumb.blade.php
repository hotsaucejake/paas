<div class="row page-titles">
    <div class="col-md-6 col-8 align-self-center">
        <h3 class="text-themecolor m-b-0 m-t-0">@yield('breadcrumb-title')</h3>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
            @yield('breadcrumb-nav')
        </ol>
    </div>
    <div class="col-md-6 col-4 align-self-center">
        @if(auth()->user()->hasRole('super-admin') || auth()->user()->hasRole('admin'))
            <button class="right-side-toggle waves-effect waves-light btn-info btn-circle btn-sm pull-right m-l-10"><i class="ti-settings text-white"></i></button>
        @endif
        @yield('breadcrumb-buttons')
    </div>
</div>
