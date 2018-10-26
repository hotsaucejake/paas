@extends('monster.app')


@section('page-title')
PaaS: Permanent Placements
@endsection


@section('page-css')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.10.18/b-1.5.2/b-colvis-1.5.2/b-html5-1.5.2/b-print-1.5.2/fh-3.1.4/r-2.2.2/datatables.min.css"/>
@endsection


@section('breadcrumb-title')
Permanent Placements: Index
@endsection


@section('breadcrumb-nav')
<li class="breadcrumb-item"><a href="{{ route('permanent_placement.index') }}">Permanent Placements</a></li>
<li class="breadcrumb-item active">Index</li>
@endsection


@section('breadcrumb-buttons')
@if(auth()->user()->hasPermissionTo('add_permanent_placements'))<a class="btn pull-right btn-success" href="{{ route('permanent_placement.create') }}"><i class="mdi mdi-plus-circle"></i> Create</a>@endif
@endsection


@section('content')

<div class="row m-t-30">
    <div class="col-12">
        <table id="myTable" class="display" style="width:100%">
            <thead>
                <tr>
                    <th data-priority="9">ID</th>
                    <th data-priority="1">Customer Name</th>
                    <th data-priority="2">Placement Name</th>
                    <th data-priority="5">Position</th>
                    <th data-priority="7">Recruiter</th>
                    <th data-priority="8">Created</th>
                    <th data-priority="6">By</th>
                    <th data-priority="4">Approved</th>
                    <th data-priority="3" width="15%">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($permanentPlacements as $placement)
                    <tr>
                        <td>{{ $placement->id }}</td>
                        <td>{{ $placement->customer_name }}</td>
                        <td>{{ $placement->placement_name }}</td>
                        <td>{{ $placement->position }}</td>
                        <td>{{ $placement->recruiter }}</td>
                        <td>{{ ($placement->created_at)->toDateString() }}</td>
                        <td>{{ $placement->user->name }}</td>
                        <td>{!! $placement->approved ? '<i class="fa fa-check fa-lg text-success"></i>' : '<i class="fa fa-times fa-lg text-danger"></i>' !!}</td>
                        <td>
                            @if(auth()->user()->hasPermissionTo('view_permanent_placements'))
                                <button type="button" class="btn btn-link">
                                    <a href="{{ route('permanent_placement.show', ['permanent_placement' => $placement->id]) }}"><i class="fa fa-eye fa-lg text-info"></i></a>
                                </button>
                            @endif
                            @if(auth()->user()->hasPermissionTo('edit_permanent_placements') || auth()->user()->id == $placement->user_id)
                                <button type="button" class="btn btn-link">
                                    <a href="{{ route('permanent_placement.edit', ['permanent_placement' => $placement->id]) }}"><i class="fa fa-edit fa-lg text-success"></i></a>
                                </button>
                            @endif
                            @if(auth()->user()->hasPermissionTo('delete_permanent_placements'))
                                <form action="{{ route('permanent_placement.destroy', ['permanent_placement' => $placement->id]) }}" method="POST" style="display: inline;">
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
                    <th>Customer Name</th>
                    <th>Placement Name</th>
                    <th>Position</th>
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
                if (data[6] == "{{ auth()->user()->name }}") {
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
                    className: 'dt-center',
                    "orderable": false
                },
            ]
        } );
    } );
</script>
@endsection
