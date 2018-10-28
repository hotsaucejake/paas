@extends('monster.app')

@section('page-title')
PaaS: Distribution Lists
@endsection


@section('page-css')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.10.18/b-1.5.2/b-colvis-1.5.2/b-html5-1.5.2/b-print-1.5.2/fh-3.1.4/r-2.2.2/datatables.min.css"/>
@endsection


@section('breadcrumb-title')
Distribution Lists: Index
@endsection


@section('breadcrumb-nav')
<li class="breadcrumb-item"><a href="{{ route('distribution_list.index') }}">Distribution Lists</a></li>
<li class="breadcrumb-item active">Index</li>
@endsection


@section('breadcrumb-buttons')
@if(auth()->user()->hasPermissionTo('add_distribution_lists'))<a class="btn pull-right btn-success" href="{{ route('distribution_list.create') }}"><i class="mdi mdi-plus-circle"></i> Create</a>@endif
@endsection


@section('content')

<div class="row m-t-30">
    <div class="col-12">
        <table id="myTable" class="display" style="width:100%">
            <thead>
                <tr>
                    <th data-priority="1">Title</th>
                    <th data-priority="4">Distribution Emails</th>
                    <th data-priority="3">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($lists as $list)
                    <tr>
                        <td>{{ $list->title }}</td>
                        <td>
                            @foreach ($list->distributionEmails as $email)
                                <span class="label label-rounded label-primary">{{ $email->email }}</span>
                            @endforeach
                        </td>
                        <td>
                            @if(auth()->user()->hasPermissionTo('edit_distribution_lists'))
                                <button type="button" class="btn btn-link">
                                    <a href="{{ route('distribution_list.edit', ['distribution_list' => $list->id]) }}"><i class="fa fa-edit fa-lg text-warning m-r-20"></i></a>
                                </button>
                            @endif
                            @if(auth()->user()->hasPermissionTo('delete_distribution_lists'))
                                <form action="{{ route('distribution_list.destroy', ['distribution_list' => $list->id]) }}" method="POST" style="display: inline;">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit" class="btn btn-link"><i class="fa fa-trash fa-lg text-danger"></i></button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th>Title</th>
                    <th>Distribution Emails</th>
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
                    className: 'dt-center',
                    "orderable": false
                },
            ]
        } );
    } );
</script>
@endsection
