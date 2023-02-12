<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Library MS | Log in</title>

        <!-- Google Font: Source Sans Pro -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="{{ URL::asset('assets/adminlte/plugins/fontawesome-free/css/all.min.css') }}">
        <!-- icheck bootstrap -->
        <link rel="stylesheet" href="{{ URL::asset('assets/adminlte/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
        <!-- Theme style -->
        <link rel="stylesheet" href="{{ URL::asset('assets/adminlte/dist/css/adminlte.min.css') }}">
    </head>
    <body class="hold-transition login-page">
        <div class="login-box">
        <!-- /.login-logo -->
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
            <a href="../../index2.html" class="h1"><b>Admin</b>LTE</a>
            </div>
            <div class="card-body">
            <p class="login-box-msg">Sign in to start your session</p>

            @if ($message = Session::get('error'))
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h5><i class="icon fas fa-ban"></i> Error!</h5>
                    {{ $message }}
                </div>
            @endif
            @if ($message = Session::get('success'))
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h5><i class="icon fas fa-check"></i> Success!</h5>
                    {{ $message }}
                </div>
            @endif
            <form action="{{ URL::to('login/verify') }}" method="post" id="loginForm">
                @csrf
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Student Number" name="stud_number">
                    <div class="input-group-append">
                        <div class="input-group-text">
                        <span class="fas fa-user"></span>
                        </div>
                    </div>
                    <div class="invalid-feedback" id="stud_number-error">
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="password" class="form-control" placeholder="Password" name="password">
                    <div class="input-group-append">
                        <div class="input-group-text">
                        <span class="fas fa-lock"></span>
                        </div>
                    </div>
                    <div class="invalid-feedback" id="password-error">
                    </div>
                </div>
                <div class="row">
                    <div class="col-8">
                    </div>
                    <!-- /.col -->
                    <div class="col-4">
                        <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>

            <p class="mb-1 mt-3">
                <a href="{{ URL::to('register') }}" class="text-center">Register a new membership</a>
            </p>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
        </div>
        <!-- /.login-box -->

        <!-- jQuery -->
        <script src="{{ URL::asset('assets/adminlte/plugins/jquery/jquery.min.js') }}"></script>
        <!-- Bootstrap 4 -->
        <script src="{{ URL::asset('assets/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <!-- AdminLTE App -->
        <script src="{{ URL::asset('assets/adminlte/dist/js/adminlte.min.js') }}"></script>
        {{-- jQuery validator --}}
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js" integrity="sha512-rstIgDs0xPgmG6RX1Aba4KV5cWJbAMcvRCVmglpam9SoHZiUCyQVDdH2LPlxoHtrv17XWblE/V/PP+Tr04hbtA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

        <script>
            $(document).ready(function() {
                $("#loginForm").validate({
                    rules: {
                        stud_number: {
                            required: true,
                        },
                        password: {
                            required: true,
                        },
                    },
                    messages: {
                        stud_number: {
                            required: "Please enter your student number",
                        },
                        password: {
                            required: "Please enter your password",
                            minlength: "Your password must be at least 5 characters long"
                        },
                    },
                    highlight: function(element) {
                        $(element).addClass('is-invalid');
                        if($(element).hasClass('is-valid'))
                            $(element).removeClass('is-valid');
                    },
                    unhighlight: function(element) {
                        $(element).addClass('is-valid');
                        if($(element).hasClass('is-invalid'))
                            $(element).removeClass('is-invalid');
                    },
                    errorPlacement: function(error, element) {
                        if (element.attr("name") == 'stud_number') {
                            $(error).appendTo("#stud_number-error");
                        }
                        if (element.attr("name") == 'password') {
                            $(error).appendTo("#password-error");
                        }
                    },
                });
            });
        </script>
    </body>
</html>
