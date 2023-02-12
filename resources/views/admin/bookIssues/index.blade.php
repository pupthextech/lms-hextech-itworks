@extends('layout')

@section('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.1/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="{{ URL::asset('assets/adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('assets/adminlte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('assets/adminlte/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.1/dist/sweetalert2.min.css">
    
@endsection

@section('content-header')
    <div class="container-fluid">
        <div class="row mb-2">
        <div class="col-sm-6">
            <h1>{{ $title }}</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ URL::to('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">{{ $title }}</li>
            </ol>
        </div>
        </div>
    </div><!-- /.container-fluid -->
@endsection

@section('content')
@inject('carbon', 'Carbon\Carbon')
<div class="card">
    <div class="card-body">
        <table id="bookIssueTable" class="table table-bordered table-striped text-center">
            <thead>
                <tr>
                    <th>Book ISBN</th>
                    <th>Student Number</th>
                    <th>Issue Date</th>
                    <th>Return Date</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($bookIssueList as $bookIssue)
    			<tr>
    				<td>{{ $bookIssue->book_isbn }}</td>
    				<td>{{ $bookIssue->student_number }} </td>
    				<td>{{ $carbon::parse($bookIssue->date_issued)->format('M, d, Y g:ia') }} </td>
    				<td>@if(!is_null($bookIssue->return_date)) {{ $carbon::parse($bookIssue->return_date)->format('M, d, Y g:ia') }}@else Not returned @endif</td>
    				<td>
                        <span @class([
                            'badge',
                            'badge-success' => $bookIssue->book_issue_status == 'Returned',
                            'badge-primary' => $bookIssue->book_issue_status == 'To Return',
                        ])>{{ $bookIssue->book_issue_status}}</span>
                    </td>
    				<td>
                        <a class="btn btn-primary btn-sm" href="{{ URL::to('admin/book_issues/details/'.$bookIssue->id) }}" role="button">Details</a>
                    </td>
    			</tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
    
@endsection

@section('scripts')

<script src="{{ URL::asset('assets/adminlte/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ URL::asset('assets/adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ URL::asset('assets/adminlte/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ URL::asset('assets/adminlte/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ URL::asset('assets/adminlte/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ URL::asset('assets/adminlte/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@if ($message = Session::get('success'))
    <script>
        Swal.fire(
            'Success!',
            '{{ $message }}!',
            'success'
        )
    </script>
@endif

{{-- ask user to confirm deletion --}}
<script>
    $('.del').on('click', function() {
        Swal.fire({
            title: 'Delete user? You can\'t reverse this!',
            icon: 'question',
            showDenyButton: true,
            confirmButtonText: 'Save',
            denyButtonText: `Don't save`,
        }).then((result) => {
        if (result.isConfirmed) {
            var form = $(this).parents('form:first');
            var url = 
            form.submit();
        } else if (result.isDenied) {
            Swal.fire('Changes are not saved', '', 'info')
        }
        })
    })
</script>

<script>
    var table = $("#bookIssueTable").DataTable({
        "responsive": true, 
        "lengthChange": false, 
        "autoWidth": false,
    });

</script>
@endsection