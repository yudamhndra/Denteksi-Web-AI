@extends('layout.master')

@section('content')
@if(session()->has('error'))
    <div class="alert alert-danger">
        {{ session()->get('error') }}
    </div>
@endif

<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h6 class="text-center h3">Tambah Dokter</h6>
                <form action="{{ route('dokter.store') }}" class="forms-sample p-3" id="dokter-store" method="post" nctype="multipart/form-data" files=true >
                    @csrf
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Email address <span class="text-danger">*</span> </label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="mail@mail.com">
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Kata sandi <span class="text-danger">*</span></label>
                        <div class="input-group mb-3 ">
                            <input type="password"
                                class="form-control @error('password') is-invalid @enderror"
                                name="password" id="password" placeholder="masukkan kata sandi">
                            <div style="background: transparent" class="input-group-prepend ml-2">
                                <div style="padding:10px"class="input-group-text"><i style="width: 100%" class="fas fa-eye-slash "
                                        id="eye"></i></div>
                            </div>
                        </div>
                      </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">NIK <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('nik') is-invalid @enderror" id="nik" name="nik" autocomplete="off" onkeypress="return isNumber(event)"
                            placeholder="Masukkan NIK" >
                            @error('nik')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Nama <span class="text-danger">*</span></label>
                        <input type="text" class="form-control  @error('nama') is-invalid @enderror"  name="nama" autocomplete="off"
                            placeholder="Masukkan Nama">
                            @error('nama')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Wilayah <span class="text-danger">*</span></label>
                        <select class="js-example-basic-single form-select" name="kecamatan" data-width="100%">
                            <option selected disabled class="mb-2" value=" ">Pilih Wilayah</option>
                            @foreach(\App\Models\Kecamatan::orderBy('nama','asc')->get() as $value => $key)
                            <option class="mb-2" value="{{$key->id}}">{{$key->nama}}</option>
                            @endforeach
                        </select>
                        @error('id_kecamatan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="col-md-12 mb-2"> Jenis Kelamin <span class="text-danger">*</span></label>
                        <div class="form-check form-check-inline">
                            <input type="radio" class="form-check-input" value="laki-laki" name="jenis_kelamin"
                                id="radioInline">
                            <label class="form-check-label" for="radioInline">
                                Laki-Laki
                            </label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input type="radio" value="perempuan" class="form-check-input" name="jenis_kelamin"
                                id="radioInline1">
                            <label class="form-check-label" for="radioInline1">
                                Perempuan
                            </label>
                        </div>
                    </div>
                    <div class="row">
                    <div class="col-md-6">
                        <label for="exampleInputPassword1" class="form-label">Tempat Lahir <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('tempat_lahir') is-invalid @enderror" id="tempat_lahir" name="tempat_lahir" autocomplete="off"
                            placeholder="Masukkan Tempat Lahir" >
                            @error('tempat_lahir')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="exampleInputPassword1" class="form-label">tanggal Lahir <span class="text-danger">*</span></label>
                        <input type="date" class="form-control @error('tanggal_lahir') is-invalid @enderror" id="tanggal" name="tanggal_lahir" autocomplete="off"
                            placeholder="Tanggal lahir">
                            @error('tanggal_lahir')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">No Handphone <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('no_telp') is-invalid @enderror" id="no_telp" name="no_telp" autocomplete="off" onkeypress="return isNumber(event)"
                            placeholder="Masukkan Nomer Handphone">
                            @error('no_telp')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">No Str <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('no_str') is-invalid @enderror" id="no_str" name="no_str" autocomplete="off"
                            placeholder="Masukkan Nomer STR">
                            @error('no_str')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div style="float: right;">
                    <button type="submit" class="btn btn-primary me-2">Tambah</button>
                    <a href="{{URL::previous()}}" type="button" class="btn btn-secondary">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('after-script')
<script type="text/javascript">
    $(document).ready(function () {
        $('#exampleCheck1').click(function () {
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
        });

        function isNumber(evt) {
            evt = (evt) ? evt : window.event;
            var charCode = (evt.which) ? evt.which : evt.keyCode;
            if (charCode > 31 && (charCode < 48 || charCode > 57)) {
                return false;
            }
            return true;
        }
    })


</script>
@endpush
