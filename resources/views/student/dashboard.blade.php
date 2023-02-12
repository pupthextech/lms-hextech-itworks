@extends('student.layout')

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
                <a href="{{ URL::to('booklist') }}" class="small-box-footer">
                More info <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>
    <div class="col">
        <div class="small-box bg-info">
            <div class="inner">
                <h3>{{ $issued_books }}</h3>
                <p>Borrowed books</p>
            </div>
            <div class="icon">
                <i class="fas fa-id-card"></i>
            </div>
                <a href="{{ URL::to('issued_books' )}}" class="small-box-footer">
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
                <a href="{{ URL::to('issued_books' )}}" class="small-box-footer">
                More info <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>
</div>
@endsection