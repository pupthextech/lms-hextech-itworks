<!DOCTYPE html>
<html lang="en">
    <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AdminLTE 3 | Registration Page (v2)</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ URL::asset('assets/adminlte/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{ URL::asset('assets/adminlte/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ URL::asset('assets/adminlte/dist/css/adminlte.css') }}">
    </head>
    <body class="hold-transition register-page">
        <div class="register-box">
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
            <a href="../../index2.html" class="h1"><b>Admin</b>LTE</a>
            </div>
            <div class="card-body">
            <p class="login-box-msg">Register a new membership</p>
            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h5><i class="icon fas fa-ban"></i> Error!</h5>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="{{ URL::to('verifyReg') }}" method="post" id="regForm" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="First Name" name="first_name">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-user"></span>
                                </div>
                            </div>
                            <div class="invalid-feedback" id="first_name-error">
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="Last Name" name="last_name">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-user"></span>
                                </div>
                            </div>
                            <div class="invalid-feedback" id="last_name-error">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="input-group mb-3">
                            <select class="form-control" name="gender">
                              <option disabled selected>Gender</option>
                              <option value="male">Male</option>
                              <option value="female">Female</option>
                            </select>
                            <div class="invalid-feedback" id="gender-error">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="Student Number" name="stud_number">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <i class="fas fa-id-card"></i>
                                </div>
                            </div>
                            <div class="invalid-feedback" id="stud_number-error">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="input-group mb-3">
                            <input type="email" class="form-control" placeholder="Email" name="email">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                                </div>
                            </div>
                            <div class="invalid-feedback" id="email-error">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="input-group mb-3">
                            <input type="password" class="form-control" placeholder="Password" name="password" id="password">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                                </div>
                            </div>
                            <div class="invalid-feedback" id="password-error">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="input-group mb-3">
                            <input type="password" class="form-control" placeholder="Retype password" name="confpass">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                                </div>
                            </div>
                            <div class="invalid-feedback" id="confpass-error">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="input-group mb-3">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="imageUpload" name="image">
                                <label class="custom-file-label" for="customFile">Choose file</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                <div class="col-8">
                </div>
                <!-- /.col -->
                <div class="col-4">
                    <button type="submit" class="btn btn-primary btn-block">Register</button>
                </div>
                <!-- /.col -->
                </div>
            </form>

            <a href="{{ URL::to('/') }}" class="text-center">I already have a membership</a>
            </div>
            <!-- /.form-box -->
        </div><!-- /.card -->
        </div>
        <!-- /.register-box -->

        <!-- jQuery -->
        <script src="{{ URL::asset('assets/adminlte/plugins/jquery/jquery.min.js') }}"></script>
        {{-- jQuery validator --}}
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js" integrity="sha512-rstIgDs0xPgmG6RX1Aba4KV5cWJbAMcvRCVmglpam9SoHZiUCyQVDdH2LPlxoHtrv17XWblE/V/PP+Tr04hbtA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/additional-methods.min.js" integrity="sha512-6S5LYNn3ZJCIm0f9L6BCerqFlQ4f5MwNKq+EthDXabtaJvg3TuFLhpno9pcm+5Ynm6jdA9xfpQoMz2fcjVMk9g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <!-- Bootstrap 4 -->
        <script src="{{ URL::asset('assets/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <!-- AdminLTE App -->
        <script src="{{ URL::asset('assets/adminlte/dist/js/adminlte.min.js') }}"></script>

        <script>
            $.validator.addMethod('filesize', function (value, element, param) {
                return this.optional(element) || (element.files[0].size <= param)
            }, 'File size must be less than {0}');
            // $.validator.addMethod(
            //     "regex",
            //     function(value, element, regexp) {
            //         var re = new RegExp(regexp);
            //         return this.optional(element) || re.test(value);
            //     },
            //     "Please check your input."
            // );

            $(document).ready(function() {
                $("#regForm").validate({
                    rules: {
                        first_name:  {
                            required: true,
                            minlength: 2,
                        },
                        last_name:  {
                            required: true,
                            minlength: 2,
                        },
                        stud_number: {
                            required: true,
                            pattern: /\d{4}-\d{5}-TG-\d{1}/,
                            minlength: 2,
                        },
                        email: {
                            required: true,
                            email: true,
                        },
                        password: {
                            required: true,
                            minlength: 2,
                        },
                        confpass: {
                            required: true,
                            minlength: 2,
                            equalTo: "#password"
                        },
                        gender: "required",
                    },
                    success: "is-valid",
                    messages: {
                        first_name: {
                            required: "Please enter your first name",
                            minlength: "Your first name must consist of at least 2 characters"
                        },
                        last_name: {
                            required: "Please enter your last name",
                            minlength: "Your last name must consist of at least 2 characters"
                        },
                        stud_number: {
                            required: "Please enter your student number",
                            minlength: "Your student number must consist of at least 2 characters",
                            pattern: "Invalid student number",
                        },
                        username: {
                            required: "Please enter a username",
                            minlength: "Your username must consist of at least 2 characters"
                        },
                        password: {
                            required: "Please provide a password",
                            minlength: "Your password must be at least 5 characters long"
                        },
                        confpass: {
                            required: "Please confirm your password",
                            minlength: "Your password must be at least 5 characters long",
                            equalTo: "Password mismatch"
                        },
                        email: "Please enter a valid email address",
                        gender: "Please select your gender.",
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
                        if (element.attr("name") == 'first_name') {
                            $(error).appendTo("#first_name-error");
                        }
                        if (element.attr("name") == 'last_name') {
                            $(error).appendTo("#last_name-error");
                        }
                        if (element.attr("name") == 'gender') {
                            $(error).appendTo("#gender-error");
                        }
                        if (element.attr("name") == 'stud_number') {
                            $(error).appendTo("#stud_number-error");
                        }
                        if (element.attr("name") == 'email') {
                            $(error).appendTo("#email-error");
                        }
                        if (element.attr("name") == 'password') {
                            $(error).appendTo("#password-error");
                        }
                        if (element.attr("name") == 'confpass') {
                            $(error).appendTo("#confpass-error");
                        }
                    },
                });
            });
        </script>

        
        <script>
            $('#imageUpload').on('change',function(e){
                //get the file name
                var fileName = e.target.files[0].name;
                //replace the "Choose a file" label
                $(this).next('.custom-file-label').html(fileName);
            })
        </script>
    </body>
</html>
