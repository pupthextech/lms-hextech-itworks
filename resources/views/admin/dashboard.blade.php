@extends('layout')

@section('content-header')
    <div class="container-fluid">
        <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Dashboard</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item active">Dashboard</li>
            </ol>
        </div>
        </div>
    </div><!-- /.container-fluid -->
@endsection

@section('content')
<div class="row">
    <div class="col">
        <div class="small-box bg-info">
            <div class="inner">
                <h3>{{ $books }}</h3>
                <p>Available Books</p>
            </div>
            <div class="icon">
                <i class="fas fa-book"></i>
            </div>
                <a href="{{ URL::to('admin/books') }}" class="small-box-footer">
                More info <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>
    <div class="col">
        <div class="small-box bg-info">
            <div class="inner">
                <h3>{{ $authors }}</h3>
                <p>Authors</p>
            </div>
            <div class="icon">
                <i class="fas fa-user"></i>
            </div>
                <a href="{{ route('authors.index') }}" class="small-box-footer">
                More info <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>
    <div class="col">
        <div class="small-box bg-info">
            <div class="inner">
                <h3>{{ $categories }}</h3>
                <p>Categories</p>
            </div>
            <div class="icon">
                <i class="fas fa-layer-group"></i>
            </div>
                <a href="{{ route('categories.index') }}" class="small-box-footer">
                More info <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>
</div>
<div class="row">
    <div class="col">
        <div class="small-box bg-info">
            <div class="inner">
                <h3>{{ $issued_books }}</h3>
                <p>Issued books</p>
            </div>
            <div class="icon">
                <i class="fas fa-id-card"></i>
            </div>
                <a href="{{ URL::to('admin/book_issues') }}" class="small-box-footer">
                More info <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>
    <div class="col">
        <div class="small-box bg-info">
            <div class="inner">
                <h3>{{ $to_return }}</h3>
                <p>Books to return</p>
            </div>
            <div class="icon">
                <i class="fas fa-undo-alt"></i>
            </div>
                <a href="{{ URL::to('admin/book_issues') }}" class="small-box-footer">
                More info <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>
    <div class="col">
        <div class="small-box bg-info">
            <div class="inner">
                <h3>{{ $returned }}</h3>
                <p>Books returned</p>
            </div>
            <div class="icon">
                <i class="fas fa-undo-alt"></i>
            </div>
                <a href="{{ URL::to('admin/book_issues') }}" class="small-box-footer">
                More info <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>
</div>
@endsection