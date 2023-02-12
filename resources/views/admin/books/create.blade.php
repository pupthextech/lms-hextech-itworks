@extends('layout')

@section('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.1/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="{{ URL::asset('assets/adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('assets/adminlte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('assets/adminlte/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
    
@endsection

@section('content-header')
    <div class="container-fluid">
        <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Add Books</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ URL::to('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ URL::to('admin/books') }}">Books</a></li>
            <li class="breadcrumb-item active">Add Books</li>
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
                <form action="{{ route('books.store') }}" method="post">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="book_name">Book Title</label>
                            <input type="text" class="form-control" id="book_name" name="book_name" placeholder="Harry Potter and the Prisoner of Azkaban">
                        </div>
                        <div class="form-group">
                            <label for="book_isbn">ISBN</label>
                            <input type="text" class="form-control" id="book_isbn" name="book_isbn" placeholder="9780439554923">
                        </div>
                        <div class="form-group">
                            <label>Author</label>
                            <select class="form-control @error('author_id') isinvalid @enderror " name="author_id" required>
                                <option value="">Select Author</option>
                                @foreach ($authors as $author)
                                    <option value="{{ $author->id }}">{{ $author->name }}</option>
                                @endforeach
                            </select>
                            @error('author_id')
                                <div class="alert alert-danger" role="alert">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Category</label>
                            <select class="form-control @error('category_id') isinvalid @enderror " name="category_id" required>
                                <option value="">Select Category</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <div class="alert alert-danger" role="alert">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="book_copy">Number of Copies</label>
                            <input type="number" class="form-control" id="book_copy" name="book_copy" placeholder="9780439554923">
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
@endsection