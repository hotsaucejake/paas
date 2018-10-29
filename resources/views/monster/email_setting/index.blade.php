@extends('monster.app')

@section('page-title')
PaaS: Email Settings
@endsection


@section('page-css')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.10.18/b-1.5.2/b-colvis-1.5.2/b-html5-1.5.2/b-print-1.5.2/fh-3.1.4/r-2.2.2/datatables.min.css"/>
@endsection


@section('breadcrumb-title')
Email Settings: Index
@endsection


@section('breadcrumb-nav')
<li class="breadcrumb-item"><a href="{{ route('email_setting.index') }}">Email Settings</a></li>
<li class="breadcrumb-item active">Index</li>
@endsection


@section('breadcrumb-buttons')
@if(auth()->user()->hasPermissionTo('add_email_settings'))<a class="btn pull-right btn-success" href="{{ route('email_setting.create') }}"><i class="mdi mdi-plus-circle"></i> Create</a>@endif
@endsection


@section('content')

<div class="row m-t-30">
    <div class="col-12">
        <table id="myTable" class="display" style="width:100%">
            <thead>
                <tr>
                    <th data-priority="7">Driver</th>
                    <th data-priority="1">Host</th>
                    <th data-priority="6">Port</th>
                    <th data-priority="4">From Address</th>
                    <th data-priority="5">From Name</th>
                    <th data-priority="3">Username</th>
                    <th data-priority="2">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($settings as $setting)
                    <tr>
                        <td>{{ $setting->driver }}</td>
                        <td>{{ $setting->host }}</td>
                        <td>{{ $setting->port }}</td>
                        <td>{{ $setting->from_address }}</td>
                        <td>{{ $setting->from_name }}</td>
                        <td>{{ $setting->username }}</td>
                        <td>
                            @if(auth()->user()->hasPermissionTo('edit_email_settings'))
                                <button type="button" class="btn btn-link">
                                    <a href="{{ route('email_setting.edit', ['email_setting' => $setting->id]) }}"><i class="fa fa-edit fa-lg text-warning m-r-20"></i></a>
                                </button>
                            @endif
                            @if(auth()->user()->hasPermissionTo('delete_email_settings'))
                                <form action="{{ route('email_setting.destroy', ['email_setting' => $setting->id]) }}" method="POST" style="display: inline;">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit" class="btn btn-link"><i class="fa fa-trash fa-lg text-danger"></i></button>
                                </form>
                            @endif
                            @if(!auth()->user()->hasPermissionTo('edit_email_settings') && !auth()->user()->hasPermissionTo('delete_email_settings')) NA @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th>Driver</th>
                    <th>Host</th>
                    <th>Port</th>
                    <th>From Address</th>
                    <th>From Name</th>
                    <th>Username</th>
                    <th>Actions</th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>


@endsection


@section('page-plugins')
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.10.18/b-1.5.2/b-colvis-1.5.2/b-html5-1.5.2/b-print-1.5.2/fh-3.1.4/r-2.2.2/datatables.min.js"></script>

<script>
    $(document).ready( function () {
        $('#myTable').DataTable( {
            responsive: true,
            "pageLength": 100,
            "order": [],
            dom: 'Bfrtip',
            buttons: [
                'copy', 'excel', 'pdf'
            ],
            columnDefs: [
                {
                    targets: 0,
                    className: 'dt-center'
                },
                {
                    targets: 1,
                    className: 'dt-center'
                },
                {
                    targets: 2,
                    className: 'dt-center'
                },
                {
                    targets: 3,
                    className: 'dt-center'
                },
                {
                    targets: 4,
                    className: 'dt-center'
                },
                {
                    targets: 5,
                    className: 'dt-center'
                },
                {
                    targets: 6,
                    className: 'dt-center',
                    "orderable": false
                },
            ]
        } );
    } );
</script>
@endsection
