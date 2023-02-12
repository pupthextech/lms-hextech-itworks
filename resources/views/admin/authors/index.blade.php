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
<div class="card">
    <div class="card-body">
        <table id="bookTable" class="table table-bordered table-striped">
            <thead>
                <tr class="text-center">
                    <th width="5%">#</th>
                    <th>Author Name</th>
                    <th>Status</th>
                    <th>Created on</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($authorList as $author)
                    <tr class="text-center">
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $author->name }}</td>
                        <td>
                            <span @class([
                                'badge',
                                'badge-success' => $author->status == 'Enable',
                                'badge-danger' => $author->status == 'Disabled',
                            ])>{{ $author->status}}</span>
                        </td>
                        <td>{{ $author->created_at }}</td>
                        <td>
                            <form action="{{ route('authors.destroy',$author->id) }}" method="POST">
                                <a class="btn btn-sm btn-success mr-2" href="{{ route('authors.edit',$author->id) }}" role="button">Edit</a>
                                
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
            title: 'Delete author? You can\'t reverse this!',
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
    var table = $("#bookTable").DataTable({
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
                    text: 'Add Author',
                    action: function ( e, dt, node, config ) {
                        window.location = '{{ URL::to('admin/authors/create') }}';
                    },
                }
            ],
        }
    });

    table.buttons().container().appendTo('#bookTable_wrapper .col-md-6:eq(0)' );
</script>
@endsection