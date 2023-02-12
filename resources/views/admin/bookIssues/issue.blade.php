@extends('layout')

@section('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.1/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="{{ URL::asset('assets/adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('assets/adminlte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('assets/adminlte/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2-bootstrap-theme/0.1.0-beta.10/select2-bootstrap.css" integrity="sha512-CbQfNVBSMAYmnzP3IC+mZZmYMP2HUnVkV4+PwuhpiMUmITtSpS7Prr3fNncV1RBOnWxzz4pYQ5EAGG4ck46Oig==" crossorigin="anonymous" referrerpolicy="no-referrer" /> --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@ttskch/select2-bootstrap4-theme@x.x.x/dist/select2-bootstrap4.min.css">
    
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
            <li class="breadcrumb-item"><a href="{{ URL::to('admin/books') }}">Books</a></li>
            <li class="breadcrumb-item active">{{ $title }}</li>
            </ol>
        </div>
        </div>
    </div><!-- /.container-fluid -->
@endsection

@section('content')

<div class="container-fluid">
    <div class="row mb-2 d-flex justify-content-center">
        <div class="col-sm-6">
            <div class="card">
                <form action="{{ URL::to('admin/book_issues/placeIssue') }}" method="post">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="book_isbn">Book Title</label>
                            <select class="custom-select" id="book_isbn" name="book_isbn">
                                <option selected disabled>Open this select menu</option>
                                @foreach($bookList as $book)
                                    <option value="{{ $book->book_isbn }}">{{ $book->book_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="student_number">Student Name</label>
                            <select class="custom-select" id="student_number" name="student_number">
                                <option selected disabled>Open this select menu</option>
                                @foreach($userList as $user)
                                    <option value="{{ $user->stud_number }}">{{ $user->first_name . ' ' . $user->last_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="card-footer d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div><!-- /.container-fluid -->
    
@endsection

@section('scripts')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        $("#book_isbn").select2({
            theme: "bootstrap4"
        });

        $("#student_number").select2({
            theme: "bootstrap4"
        });
    </script>
@endsection