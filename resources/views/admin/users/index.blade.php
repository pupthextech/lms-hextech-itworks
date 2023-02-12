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
        <table id="userTable" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Email Address</th>
                    <th>Contact No.</th>
                    <th>Address</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($userList as $user)
    			<tr>
    				<td>
                        <img src="{{ URL::asset('uploads/profile/'.$user->image) }}" class="img-thumbnail" width="75" />
                    </td>
    				<td>{{ $user->first_name }} {{ $user->last_name }}</td>
    				<td>{{ $user->email }} </td>
    				<td>{{ $user->stud_number }} </td>
    				<td>{{ $user->address}}</td>
    				<td>
                        <span @class([
                            'badge',
                            'badge-success' => $user->status == 'Enable',
                            'badge-danger' => $user->status == 'Disabled',
                        ])>{{ $user->status}}</span>
                    </td>
    				<td>
                        <button type="button" name="delete_button" class="btn btn-danger btn-sm">Change status</button>
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
    var table = $("#userTable").DataTable({
        "responsive": true, 
        "autoWidth": false,
    });

</script>
@endsection