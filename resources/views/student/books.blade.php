@extends('student.layout')

@section('styles')
    <link rel="stylesheet" href="{{ URL::asset('assets/adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('assets/adminlte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('assets/adminlte/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
@endsection

@section('content-header')
    <div class="container">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0"> {{ $title }} </h1>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
@endsection

@section('content')
<!-- Default box -->
<div class="card">
    <div class="card-header">
        <h3 class="card-title">
            <i class="fas fa-table mr-2"></i>
            Issued books
        </h3>
    </div>
    <div class="card-body">
        <table id="bookTable" class="table table-bordered table-striped">
            <thead>
                <tr class="text-center">
                    <th width="10%">ISBN</th>
                    <th>Book Name</th>
                    <th>Author</th>
                    <th>Category</th>
                    <th>Available Copies</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($books as $book)
                    <tr class="text-center">
                        <td>{{ $book->book_isbn }}</td>
                        <td>{{ $book->book_name }}</td>
                        <td>{{ $book->author->name }}</td>
                        <td>{{ $book->category->category_name }}</td>
                        <td>{{ $book->book_copy }}</td>
                        <td>
                            <span @class([
                                'badge',
                                'badge-success' => $book->status == 'Enable',
                                'badge-danger' => $book->status == 'Disabled',
                            ])>{{ $book->status}}</span>
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

    
<script>
    var table = $("#bookTable").DataTable({
        "responsive": true, 
        "autoWidth": false,
    });
</script>
@endsection