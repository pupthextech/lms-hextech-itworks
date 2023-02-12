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

@if(is_null($issued->return_date))
    <div class="row">
        <div class="col">
            <button class="btn btn-primary" data-url="{{ URL::to('admin/book_issues/return/'.$issued->id) }}" id="returnBtn">Return</button>
        </div>
    </div> 
@endif

<div class="row mt-2">
    <div class="col">
        <div class="info-box bg-light">
            <div class="info-box-content">
                <span class="info-box-text text-center text-muted">Book Issue Date</span>
                <span class="info-box-number text-center text-muted mb-0">{{ $carbon::parse($issued->date_issued)->format('M, d, Y g:ia') }}</span>
            </div>
        </div>
    </div>
    <div class="col">
        <div class="info-box bg-light">
            <div class="info-box-content">
                <span class="info-box-text text-center text-muted">Book Return Date</span>
                <span class="info-box-number text-center text-muted mb-0">@if(!is_null($issued->return_date)) {{ $carbon::parse($issued->return_date)->format('M, d, Y g:ia') }} @else Not returned @endif</span>
            </div>
        </div>
    </div>
    <div class="col">
        <div class="info-box bg-light">
            <div class="info-box-content">
                <span class="info-box-text text-center text-muted">Book Issue Status</span>
                <span class="info-box-number text-center text-muted mb-0">
                    <span @class([
                        'badge',
                        'badge-success' => $issued->book_issue_status == 'Returned',
                        'badge-primary' => $issued->book_issue_status == 'To Return',
                    ])>{{ $issued->book_issue_status}}</span>
                </span>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Book Details</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                    <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <tr>
                        <th width="30%">ISBN Number</th>
                        <td width="70%">{{ $book->book_isbn}}</td>
                    </tr>
                    <tr>
                        <th width="30%">Book Title</th>
                        <td width="70%">{{ $book->book_name}}</td>
                    </tr>
                    <tr>
                        <th width="30%">Author</th>
                        <td width="70%">{{ $book->author->name }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    <div class="col">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">User Details</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                    <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <table class="table table-bordered">
                        <tr>
                            <th width="30%">Student Number</th>
                            <td width="70%">{{ $user->stud_number }}</td>
                        </tr>
                        <tr>
                            <th width="30%">Name</th>
                            <td width="70%">{{ $user->first_name}} {{ $user->last_name }}</td>
                        </tr>
                        <tr>
                            <th width="30%">Address</th>
                            <td width="70%">{{ $user->address }}</td>
                        </tr>
                        <tr>
                            <th width="30%">User Email Address</th>
                            <td width="70%">{{ $user->email }}</td>
                        </tr>
                        <tr>
                            <th width="30%">User Image</th>
                            <td width="70%"><img src="{{ URL::asset('uploads/profile/'.$user->image) }}" class="img-thumbnail" width="100" /></td>
                        </tr>
                    </table>
                    <br />
                </table>
            </div>
        </div>
    </div>
</div>
    
@endsection

@section('scripts')

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

<script>
    $('#returnBtn').on('click', function() {
        var url = $(this).attr('data-url');
        Swal.fire({
            title: 'Do you want to return the book?',
            icon: 'question',
            showDenyButton: true,
            confirmButtonText: 'Yes',
            denyButtonText: `No`,
        }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
        if (result.isConfirmed) {
            window.location.replace(url);
        } else if (result.isDenied) {
            Swal.fire('Changes are not saved', '', 'info')
        }
        })
    });
</script>
@endsection