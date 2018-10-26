@extends('monster.app')


@section('page-title')
PaaS: Contract Billings
@endsection


@section('page-css')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.10.18/b-1.5.2/b-colvis-1.5.2/b-html5-1.5.2/b-print-1.5.2/fh-3.1.4/r-2.2.2/datatables.min.css"/>
@endsection


@section('breadcrumb-title')
Contract Billings: Index
@endsection


@section('breadcrumb-nav')
<li class="breadcrumb-item"><a href="{{ route('contract_billing.index') }}">Contract Billings</a></li>
<li class="breadcrumb-item active">Index</li>
@endsection


@section('breadcrumb-buttons')
@if(auth()->user()->hasPermissionTo('add_contract_billings'))<a class="btn pull-right btn-success" href="{{ route('contract_billing.create') }}"><i class="mdi mdi-plus-circle"></i> Create</a>@endif
@endsection


@section('content')

<div class="row m-t-30">
    <div class="col-12">
        <table id="myTable" class="display" style="width:100%">
            <thead>
                <tr>
                    <th data-priority="9">ID</th>
                    <th data-priority="1">First</th>
                    <th data-priority="2">Last</th>
                    <th data-priority="5">Client</th>
                    <th data-priority="6">Job Title</th>
                    <th data-priority="10">Recruiter</th>
                    <th data-priority="8">Created</th>
                    <th data-priority="7">By</th>
                    <th data-priority="4">Approved</th>
                    <th data-priority="3" width="15%">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($contractBillings as $billing)
                    <tr>
                        <td>{{ $billing->id }}</td>
                        <td>{{ $billing->first_name }}</td>
                        <td>{{ $billing->last_name }}</td>
                        <td>{{ $billing->client_name }}</td>
                        <td>{{ $billing->job_title }}</td>
                        <td>{{ $billing->recruiter }}</td>
                        <td>{{ ($billing->created_at)->toDateString() }}</td>
                        <td>{{ $billing->user->name }}</td>
                        <td>{!! $billing->approved ? '<i class="fa fa-check fa-lg text-success"></i>' : '<i class="fa fa-times fa-lg text-danger"></i>' !!}</td>
                        <td>
                            @if(auth()->user()->hasPermissionTo('view_contract_billings'))
                                <button type="button" class="btn btn-link">
                                    <a href="{{ route('contract_billing.show', ['contract_billing' => $billing->id]) }}"><i class="fa fa-eye fa-lg text-info"></i></a>
                                </button>
                            @endif
                            @if(auth()->user()->hasPermissionTo('edit_contract_billings') || auth()->user()->id == $billing->user_id)
                                <button type="button" class="btn btn-link">
                                    <a href="{{ route('contract_billing.edit', ['contract_billing' => $billing->id]) }}"><i class="fa fa-edit fa-lg text-success"></i></a>
                                </button>
                            @endif
                            @if(auth()->user()->hasPermissionTo('delete_contract_billings'))
                                <form action="{{ route('contract_billing.destroy', ['contract_billing' => $billing->id]) }}" method="POST" style="display: inline;">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit" class="btn btn-link" onclick="return confirm('Are you sure you wish to delete this?');">
                                        <i class="fa fa-trash fa-lg text-danger"></i>
                                    </button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th>ID</th>
                    <th>First</th>
                    <th>Last</th>
                    <th>Client</th>
                    <th>Job Title</th>
                    <th>Recruiter</th>
                    <th>Created</th>
                    <th>By</th>
                    <th>Approved</th>
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
            "pageLength": 50,
            "order": [],
            dom: 'lfrtip',
            buttons: [
                'copy', 'excel', 'pdf'
            ],
            "rowCallback": function( row, data, index ) {
                if (data[7] == "{{ auth()->user()->name }}") {
                    $('td', row).css('background-color', '#dfdfdf');
                }
            },
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
                    className: 'dt-center',
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
                    className: 'dt-center'
                },
                {
                    targets: 7,
                    className: 'dt-center'
                },
                {
                    targets: 8,
                    className: 'dt-center'
                },
                {
                    targets: 8,
                    className: 'dt-center',
                    "orderable": false
                },
            ]
        } );
    } );
</script>
@endsection
