<!DOCTYPE html>

<html lang="en">


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="author" content="NobleUI">
    <meta name="keywords"
        content="nobleui, bootstrap, bootstrap 5, bootstrap5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">

    <title>Senyumin- Login </title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css">
    <!-- End fonts -->

    <!-- core:css -->
    <link rel="stylesheet" href="{{asset('assets/vendors/core/core.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendors/select2/select2.min.css')}}">
    <!-- endinject -->

    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="{{asset('assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendors/datatables.net-bs4/dataTables.bootstrap4.css')}}">
    <!-- End plugin css for this page -->

    <!-- inject:css -->
    <link rel="stylesheet" href="{{asset('assets/fonts/feather-font/css/iconfont.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendors/flag-icon-css/css/flag-icon.min.css')}}">
    <!-- endinject -->

    <!-- Layout styles -->
    <link rel="stylesheet" href="{{asset('assets/css/demo1/style.css')}}">
    <!-- End layout styles -->

    <link rel="shortcut icon" href="{{asset('assets/images/logo-senyumin.png')}}" />
</head>
<style>

    .error{
        color: red;
    }
    .page-content {
        background: #56CFE0;
    }
    .btn-fill {
        background: #29A1B1;
        font-weight: bold;
        color: #ffffff;
    }
    .btn-outline {
        border: 2px solid #29A1B1;
        color: #29A1B1;
        font-weight: bold;
    }
    .btn:hover {
        background: #238b99;
    }
    .btn-outline:hover {
        background: #29A1B1;
        color: #ffffff;
    }
    .footer {
        background: #367781;
    }
    a {
        color: #303030;
    }
    .input-round {
        border-radius: 50px;
        border: 1.55px solid #8C8C8C;
    }
    .rounded {
        border-radius: 0.75rem !important
    }

    .auth-page {
        width: 65%
    }



    @media only screen and (max-width: 767px) {
      .auth-page{
        width: 100%
      }

    }

    @media only screen and (min-device-width:767px) and (max-device-width:960px){
      .auth-page{
        width: 100%
      }
    }

</style>

<body>
    <div class="main-wrapper">
        <div class="page-wrapper full-page">
            <div class="page-content m-0 pb-3 pb-md-1 pt-4">
                <div class="container d-flex justify-content-between align-items-center">
                    <img src="{{asset('assets/images/logo-putih.png')}}" alt="logo" srcset="">
                    {{-- <a href="/register" class="btn btn-login rounded-pill fw-bold text-light p-2 px-4">BUAT AKUN</a> --}}
                </div>
            </div>
            <div class="page-content d-flex align-items-center justify-content-center pt-0 pb-4">
                <div class="row mx-0 auth-page ">
                    <div class="col-sm-8 col-md-12 col col-lg-10 col-xl-8 col-xxl-6 mx-auto">
                        <div class="card shadow px-3 py-1 rounded">
                            <div class="row ">
                                <div class="col-md-12 ps-md-0">
                                    <div class="auth-form-wrapper px-0 px-md-4 py-3">
                                        <div class="text-center p-3">
                                            {{-- <img class="w-50 mb-3" src="{{asset('assets/images/logo-senyumin.png')}}" alt="" srcset=""> --}}
                                            <h1 class="mb-1 fw-bolder">Selamat Datang!</h1>
                                            <p>Silahkan masuk untuk melanjutkan</p>
                                        </div>
                                        @if(Session::has('error'))
                                        <div class="alert alert-warning text-center my-0 mx-4">{{Session::get('error')}}</div>
                                        @endif
                                        <form class="forms-sample p-3" action="{{route('login')}}" id="form-login" method="POST">
                                            @csrf
                                            <div class="m-2 mb-3">
                                                {{-- <label for="userEmail" class="form-label">Email</label> --}}
                                                <input type="email"
                                                    class="form-control input-round px-4 @error('email') is-invalid @enderror"
                                                    name="email" value="{{old('email')}}" id="userEmail"
                                                    placeholder="Email">

                                                @error('email')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            {{-- <div class="mb-3">
                                                <label for="userPassword" class="form-label">Password</label>
                                                <input type="password"
                                                    class="form-control @error('password') is-invalid @enderror"
                                                    name="password" id="userPassword" autocomplete="current-password"
                                                    placeholder="masukkan password">

                                                @error('password')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="form-check mb-2">
                                                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                                <label class="form-check-label" for="exampleCheck1">
                                                    Tampilkan Password
                                                </label>
                                            </div> --}}
                                            <div class="form-group p-2 mb-2">
                                                {{-- <label for="password">Password</label> --}}
                                                <div class="input-group form-control input-round p-0">
                                                    <input type="password" class="form-control border-0 rounded-pill px-4" id="password" name="password" placeholder="Password" required>
                                                    {{-- <div style="background: transparent" class="input-group-prepend ml-2"> --}}
                                                    <div style="padding:8px"class="me-2"><i style="width: 100%" class="fas fa-eye-slash" id="eye"></i></div>
                                                    {{-- </div> --}}
                                                </div>
                                            </div>
                                            <a href="#" class="text-decoration-underline p-3">Lupa password?</a>
                                            <div class="text-center p-2 mt-2">
                                                <button type="submit" class="btn btn-fill w-100 me-2 mb-2 mb-md-0 text-white rounded-pill">MASUK</button>
                                            </div>
                                            <div class="d-flex align-items-center">
                                                <hr class="flex-grow-1 mx-2">atau<hr class="flex-grow-1 mx-2">
                                            </div>
                                            <a href="{{route('auth.google')}}" class="btn btn-outline rounded-pill d-flex justify-content-between w-100 ps-2 mt-1">
                                                <img class="img-fluid" src="{{asset('assets/images/google.png')}}">
                                                Masuk dengan Google
                                                <div></div>
                                            </a>
                                            <p class="text-center mt-5 mb-2">Belum punya akun?</p>
                                            <a href="/register" class="btn btn-outline rounded-pill w-100">Buat Akun</a>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @include('layout.footer')
        </div>
    </div>

    <!-- core:js -->
    <script src="{{asset('assets/vendors/core/core.js')}}"></script>
    <!-- endinject -->

    <!-- Plugin js for this page -->
    <!-- End plugin js for this page -->

    <!-- inject:js -->
    <script src="{{asset('assets/vendors/feather-icons/feather.min.js')}}"></script>
    <script src="{{asset('assets/js/template.js')}}"></script>
    <script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.14.0/jquery.validate.js"></script>
    <!-- endinject -->

    <!-- Custom js for this page -->
    <!-- End custom js for this page -->
    <script type="text/javascript">
        $(document).ready(function () {
            $('#eye').click(function () {
                if ($(this).hasClass('fa-eye-slash')) {
                    $(this).removeClass('fa-eye-slash');
                    $(this).addClass('fa-eye');
                    $('#password').attr('type', 'text');
                } else {
                    $(this).removeClass('fa-eye');
                    $(this).addClass('fa-eye-slash');
                    $('#password').attr('type', 'password');
                }
            });

            $("#form-login").validate({
                rules: {
                    email: "required",
                    password: {
                        required: true,
                    },
                },
                messages: {
                    email: "Email tidak boleh kosong",
                    password: {
                        required: "Password tidak boleh kosong",
                    },
                },
                errorPlacement: function(error, element){

                    if (element.attr("name") == "password") {
                        error.insertAfter(element.parent());
                    } else {
                        error.insertAfter(element);
                    }
                },
                submitHandler: function(form) {
                    form.submit();
                }
            });
        });
    </script>
</body>
</html>
