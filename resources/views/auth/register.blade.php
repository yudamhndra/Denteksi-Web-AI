<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="author" content="NobleUI">
    <meta name="keywords"
        content="nobleui, bootstrap, bootstrap 5, bootstrap5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">

    <title>Senyumin - Register</title>

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
    <link rel="stylesheet" href="{{asset('assets/vendors/dropify/dist/dropify.min.css')}}">

    <link href="{{asset('select2/dist/css/select2.min.css')}}" rel="stylesheet" />
    <link rel="stylesheet" href="{{asset('select2/dist/css/select2-bootstrap4.min.css')}}">

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
        color: #29A1B1;
    }
    select {
        border-radius: 50px !important;
        border: 1.55px solid #8C8C8C !important;
    }
    .custom-select {
        border-radius: 50px !important;
        border: 1.55px solid #8C8C8C !important;
    }
    .auth-page{
      width: 75%
    }
    .form-control, .form-select {
        border-radius: 50px;
        border: 1.55px solid #8C8C8C;
    }
    .rounded {
        border-radius: 0.75rem !important
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
                    <img src="{{asset('assets/images/logo-putih.png')}}" alt="" srcset="">
                    {{-- <a href="/" class="btn btn-register rounded-pill fw-bold text-light p-2 px-5">MASUK</a> --}}
                </div>
            </div>
            <div class="page-content d-flex align-items-center justify-content-center m-0 pt-0 pb-5">
                <div class="row m-0 auth-page">
                    <div class="col-auto col mx-auto my-0">
                        <div class="card shadow rounded">
                            <div class="row">
                                <div class="col ps-md-0">
                                    <div class="auth-form-wrapper px-0 px-lg-5 py-5">
                                        <div class="text-center m-3">
                                            @if(Session::has('error'))
                                            <div class="alert alert-warning">{{Session::get('error')}}</div>
                                            @endif
                                            <h1 class="mb-1 fw-bolder">Mulai Bergabung!</h1>
                                            <p>Bersama Senyumin untuk senyuman sehat</p>
                                        </div>
                                        <form class="forms-sample mt-4" action="{{route('registeruser')}}" method="POST"
                                            enctype="multipart/form-data" id="form-register" files=true>
                                            @csrf
                                            <div class="row m-3">
                                                <input type="hidden" name="google_id" value="{{ session('user') ? session('user')->id : '' }}">
                                                <div class="col-12 col-md pb-3 pb-md-0">
                                                    <label for="userEmail" class="form-label">Email <span class="text-danger">*</span></label>
                                                    <input type="email" class="form-control form-css" id="userEmail" name="email" placeholder="Masukkan Email" value="{{ session('user') ? session('user')->email : '' }}" {{ session('user') ? 'readonly' : '' }} required>
                                                    @error('email')
                                                    <div class="badge bg-danger mt-2 ">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="col-12 col-md {{ session('user') ? 'd-none' : '' }}">
                                                    <label for="userPassword" class="form-label">Password <span class="text-danger">*</span></label>
                                                    <div class="input-group form-control p-0">
                                                        <input type="password" class="form-control rounded-pill border-0" name="password" id="password" placeholder="Masukkan password" value="{{ session('user') ? session('user')->password : '' }}" required>
                                                        {{-- <div style="background: transparent" class="input-group-prepend ml-2"> --}}
                                                            <div style="padding:8px"class="me-2"><i style="width: 100%" class="fas fa-eye-slash" id="eye"></i></div>
                                                        {{-- </div> --}}
                                                    </div>
                                                    <div id="error-password"></div>
                                                    @error('password')
                                                    <div class="badge bg-danger mt-2 ">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="row m-3">
                                                <div class="col-md-9">
                                                    <label for="exampleInputUsername1" class="form-label">Nama <span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" autocomplete="Name" placeholder="Masukkan nama" name="nama" id="name" value="{{ session('user') ? session('user')->name : old('nama')}}" {{ session('user') ? 'readonly' : '' }} required>
                                                </div>
                                                <div class="col-md-3 pt-3 pt-md-0">
                                                    <label class="form-label">Pendidikan <span class="text-danger">*</span></label>
                                                    <select class="" name="pendidikan" id="pendidikan"
                                                        data-width="100%" required>
                                                        <option selected disabled>Pilih Pendidikan</option>
                                                        <option value="SD">SD</option>
                                                        <option value="SMP">SMP</option>
                                                        <option value="SMA">SMA/SMK</option>
                                                        <option value="D1">D1</option>
                                                        <option value="D2">D2</option>
                                                        <option value="D3">D3</option>
                                                        <option value="D4">D4</option>
                                                        <option value="S1">S1</option>
                                                        <option value="S2">S2</option>
                                                        <option value="S3">S3</option>

                                                    </select>
                                                    <div id="error-pendidikan"></div>
                                                </div>
                                            </div>
                                            <div class="row m-3">
                                                <div class="col-md-4">
                                                    <label for="exampleInputPassword1" class="form-label">Tempat
                                                        Lahir <span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" id="tempat_lahir"
                                                        name="tempat_lahir" autocomplete="off"
                                                        placeholder="Masukkan tempat Lahir" required>
                                                </div>
                                                <div class="col-md-4 pt-3 pt-md-0">
                                                    <label for="exampleInputPassword1" class="form-label">Tanggal
                                                        Lahir <span class="text-danger">*</span></label>
                                                    <input type="date" class="form-control" id="tanggal_lahir"
                                                        name="tanggal_lahir" autocomplete="off"
                                                        placeholder="masukkan tanggal lahir" required>
                                                </div>
                                                <div class="col-md-4 pt-3 pt-md-0">
                                                    {{-- //TODO: field baru, belum diatur --}}
                                                    <label for="exampleInputPassword1" class="form-label">No HP
                                                        <span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" id="no_hp"
                                                        name="no_hp" autocomplete="off"
                                                        placeholder="Masukkan No HP" required>
                                                </div>
                                            </div>
                                            <div class="row m-3">
                                                <div class="col">
                                                    <label for="exampleInputUsername2" class="form-label">Alamat <span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" autocomplete="alamat"
                                                        placeholder="Masukkan alamat" name="alamat" required>
                                                </div>
                                            </div>


                                            <div class="row m-3">
                                                <div class="col-md-6">
                                                    <label class="form-label">Provinsi <span class="text-danger">*</span></label>
                                                    <select class="border form-select" name="id_provinsi" id="id_provinsi"
                                                        data-width="100%" required>
                                                        <option class="mb-2" value=" ">---Pilih Provinsi---</option>
                                                        {{--@foreach(\App\Models\Provinsi::orderBy('nama','asc')->get() as
                                                        $value => $key)
                                                        <option value="{{$key->id}}">{{$key->nama}}</option>
                                                        @endforeach--}}
                                                    </select>
                                                    <div id="error-provinsi"></div>
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label">Kabupaten/Kota <span class="text-danger">*</span></label>
                                                    <select class="border form-select" name="id_kabupaten" id="id_kabupaten"
                                                        data-width="100%" required>
                                                        <option class="mb-2" value="">---Pilih Kabupaten---</option>
                                                        {{--@foreach(\App\Models\Kecamatan::orderBy('nama','asc')->get() as
                                                        $value => $key)
                                                        <option value="{{$key->id}}">{{$key->nama}}</option>
                                                        @endforeach--}}
                                                    </select>
                                                    <div id="error-kecamatan"></div>
                                                </div>
                                            </div>
                                            <div class="row m-3">
                                                <div class="col-md-6">
                                                    <label class="form-label">Kecamatan <span class="text-danger">*</span></label>
                                                    <select class="border form-select" name="id_kecamatan2" id="id_kecamatan2"
                                                        data-width="100%" required>
                                                        <option class="mb-2" value=" ">---Pilih kecamatan---</option>
                                                        {{--@foreach(\App\Models\kecamatan::orderBy('nama','asc')->get() as
                                                        $value => $key)
                                                        <option value="{{$key->id}}">{{$key->nama}}</option>
                                                        @endforeach--}}
                                                    </select>
                                                    <div id="error-kecamatan"></div>
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label">Kelurahan <span class="text-danger">*</span></label>
                                                    <select class="border form-select" name="id_desa2" id="id_desa2"
                                                        data-width="100%" required>
                                                        <option class="mb-2" value="">---Pilih kelurahan---</option>
                                                        {{--@foreach(\App\Models\Kecamatan::orderBy('nama','asc')->get() as
                                                        $value => $key)
                                                        <option value="{{$key->id}}">{{$key->nama}}</option>
                                                        @endforeach--}}
                                                    </select>
                                                    <div id="error-desa"></div>
                                                </div>
                                            </div>

                                            {{-- <div class="mb-3">
                                                <label for="exampleInputPassword1" class="form-label">Foto Gigi
                                                    Orangtua</label>
                                                <input type="file" class="form-control dropify" name="foto"
                                                    placeholder="masukkan gambar">
                                                @error('foto')
                                                <div class="badge bg-danger mt-2 ">{{ $message }}</div>
                                                @enderror
                                            </div> --}}
                                            <div class="row m-4 mb-0 p-1 pb-0">
                                                <button type="submit" class="btn btn-fill fw-bold text-white me-2 mb-2 mb-md-0 rounded-pill">BUAT AKUN</button>
                                                @if (!Session::has('user'))
                                                    <div class="d-flex align-items-center">
                                                        <hr class="flex-grow-1 mx-2">atau<hr class="flex-grow-1 mx-2">
                                                    </div>
                                                    <a href="{{route('auth.google')}}" class="btn btn-outline rounded-pill d-flex justify-content-between w-100 ps-2 mt-1">
                                                        <img src="{{asset('assets/images/google.png')}}">
                                                        Daftar dengan Google
                                                        <div></div>
                                                    </a>
                                                    <p class="mt-5 mb-2 text-center">Sudah punya akun?</p>
                                                    <a href="/" class="btn btn-outline rounded-pill w-100">Masuk</a>
                                                @endif
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @include('layout.footer')
           {{--<div class="footer py-3">
                <div class="container text-light d-flex justify-content-between align-items-center">
                    <small>Copyright &copy; 2022 Puskesmas Kebayoran Baru</small><br>
                    <small><a href="https://api.whatsapp.com/send?phone=6281291996680" class="text-white text-decoration-underline">+62 812-9199-6680</a></small>
                </div>
            </div>--}}
        </div>
    </div>

    <script src="{{asset('assets/vendors/core/core.js')}}"></script>
    <script src="{{asset('assets/vendors/dropify/dist/dropify.min.js')}}"></script>
    <script src="{{asset('assets/vendors/js/dropify.js')}}"></script>
    <script src="{{asset('select2/dist/js/select2.min.js')}}"></script>
    <script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.14.0/jquery.validate.js"></script>



<script>

    const selectProvinsi = document.getElementById('id_provinsi');
    const selectKabupaten = document.getElementById('id_kabupaten');
    const selectKecamatan = document.getElementById('id_kecamatan2');
    const selectKelurahan = document.getElementById('id_desa2');

    fetch(`https://kanglerian.github.io/api-wilayah-indonesia/api/provinces.json`)
    .then(response => response.json())
    .then(province => {
        var data = province;
        var selectProvinsi = document.getElementById('id_provinsi');
        selectProvinsi.innerHTML = `<option class="mb-2">--Pilih Provinsi</option>`;
        data.forEach(element => {
            selectProvinsi.innerHTML += `<option data-reg="${element.id}" value="${element.name}" class="mb-2">${element.name}</option>`;
        });
    });


    selectProvinsi.addEventListener('change', (e) => {
        var provinsi = e.target.options[e.target.selectedIndex].dataset.reg;
        fetch(`https://kanglerian.github.io/api-wilayah-indonesia/api/regencies/${provinsi}.json`)
        .then(response => response.json())
        .then(regencies => {
            var data = regencies;
            data.forEach(element => {
                selectKabupaten.innerHTML += `<option data-dist="${element.id}" value="${element.name}" class="mb-2">${element.name}</option>`;
            });
        });
    });

    selectKabupaten.addEventListener('change', (e) => {
        var kabupaten = e.target.options[e.target.selectedIndex].dataset.dist;
        fetch(`https://kanglerian.github.io/api-wilayah-indonesia/api/districts/${kabupaten}.json`)
        .then(response => response.json())
        .then(districts => {
            var data = districts;
            data.forEach(element => {
                selectKecamatan.innerHTML += `<option data-vill="${element.id}" value="${element.name}" class="mb-2">${element.name}</option>`;
            });
        });
    });

    selectKecamatan.addEventListener('change', (e) => {
        var kecamatan = e.target.options[e.target.selectedIndex].dataset.vill;
        fetch(`https://kanglerian.github.io/api-wilayah-indonesia/api/villages/${kecamatan}.json`)
        .then(response => response.json())
        .then(villages => {
            var data = villages;
            data.forEach(element => {
                selectKelurahan.innerHTML += `<option value="${element.name}" class="mb-2">${element.name}</option>`;
            });

        });
    });
    selectKelurahan.addEventListener('change', (e) => {
        var kelurahan = e.target.options[e.target.selectedIndex].dataset;
        });
</script>



    <script type="text/javascript">
        $(document).ready(function () {

            var email = $('#userEmail');
            var password = $('#userPassword');
            var name = $('#name');

            $('#tempat_lahir,#name').on('input', function () {
                var currentVal = $(this).val();
                var capitalizedVal = capitalizeAfterSpace(currentVal);
                $(this).val(capitalizedVal);
            });

            function capitalizeAfterSpace(str) {
                var words = str.split(' ');
                for (var i = 0; i < words.length; i++) {
                    if (words[i].length > 0) {
                        words[i] = words[i].charAt(0).toUpperCase() + words[i].slice(1).toLowerCase();
                    }
                }
                return words.join(' ');
            }

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

            $('#id_kecamatan').change(function () {
                let kecamatan = $("#id_kecamatan").val()
                $("#id_desa").children().remove();
                $("#id_desa").val('');
                $("#id_desa").append('<option value="">---Pilih Kelurahan---</option>');
                $("#id_desa").prop('disabled', true)
                if (kecamatan != '' && kecamatan != null) {
                    $.ajax({
                        url: "{{url('')}}/list-desa/" + kecamatan,
                        success: function (res) {
                            $("#id_desa").prop('disabled', false)
                            let tampilan_option = '';
                            $.each(res, function (index, desa) {
                                tampilan_option +=
                                    `<option value="${desa.id}">${desa.nama}</option>`
                            })
                            $("#id_desa").append(tampilan_option);
                        },
                    });
                }
            });
            $('.dropify').dropify({
                messages: {
                    'default': 'Drag and drop a file here or click',
                    'replace': 'Drag and drop or click to replace',
                    'remove': 'Hapus',
                    'error': 'Ooops, something wrong happended.'
                }
            });

            $('#id_kecamatan').select2()
            $('#id_desa , #pendidikan').select2()
            $("#id_desa").append('<option value="">---Pilih Kelurahan---</option>');

            $("#form-register").validate({
                rules: {
                    email: "required",


                },
                messages: {
                    email: "Email tidak boleh kosong",
                    password: {
                        required: "Password tidak boleh kosong",

                    },
                    nama:"Nama tidak boleh kosong",
                    tempat_lahir:"Tempat lahir tidak boleh kosong",
                    tanggal_lahir:"Tanggal lahir tidak boleh kosong",
                    pendidikan:"pendidikan tidak boleh kosong",
                    alamat:"Alamat tidak boleh kosong",
                    id_kelurahan :"Kelurahan tidak boleh kosong"


                },
                 errorPlacement: function(error, element)
            {
            if ( element.is(":radio") )
            {
                error.appendTo( element.parents('.form-group') );
            } else if (element.is("select[name='pendidikan']")) {
                error.appendTo("#error-pendidikan");
            }else if (element.is("select[name='id_kecamatan']")) {
                error.appendTo("#error-kecamatan");
            }else if (element.is("select[name='id_kelurahan']")) {
                error.appendTo("#error-kelurahan");
            }else if (element.is("input[name='password']")) {
                error.appendTo("#error-password");
            }else {
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
