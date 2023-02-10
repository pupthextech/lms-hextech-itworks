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
            <h1>Book Genre</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ URL::to('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Book Genres</li>
            </ol>
        </div>
        </div>
    </div><!-- /.container-fluid -->
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <table id="genreTable" class="table table-bordered table-striped">
            <thead>
                <tr class="text-center">
                    <th width="5%">#</th>
                    <th>Genre Name</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($genreList as $genre)
                    <tr class="text-center">
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $genre->name }}</td>
                        <td>
                            <form action="{{ route('genre.books.destroy',$genre->id) }}" method="POST">
                                <a class="btn btn-sm btn-success mr-2" href="{{ route('genre.books.edit',$genre->id) }}" role="button">Edit</a>
                                
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn btn-danger btn-sm del">Delete</button>
                            </form>
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
            title: 'Delete genre? You can\'t reverse this!',
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
    var table = $("#genreTable").DataTable({
        "responsive": true, 
        "lengthChange": false, 
        "autoWidth": false,
        // dom: 'Bfrtip',
        buttons: {
            dom: {
                button: {
                    className: 'btn btn-primary btn-rounded'
                }
            },
            buttons: [
                {
                    text: 'Add Genre',
                    action: function ( e, dt, node, config ) {
                        window.location = '{{ URL::to('admin/genre/books/create') }}';
                    },
                }
            ],
        }
    });

    table.buttons().container().appendTo('#genreTable_wrapper .col-md-6:eq(0)' );
</script>
@endsection