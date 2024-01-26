@extends('layout.master')
@section('title') Data Dokter @endsection
@section('navbar-title') Dokter @endsection
@section('content')

@if(session()->has('error'))
    <div class="alert alert-danger">
        {{ session()->get('error') }}
    </div>
@endif
<div class="row">
    <div class="d-md-none">&nbsp;</div>
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h6 class="text-center h3 my-4">Tambah Dokter</h6>
                <form action="{{ route('orangtua.store') }}" class="forms-sample" id="orangtua-store" method="post"
                    nctype="multipart/form-data" files=true>
                    @csrf
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Nama <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="nama" name="nama" autocomplete="off" 
                            placeholder="Masukkan Nama" value="{{old('nama')}}">
                            @error('nama')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Email <span class="text-danger">*</span></label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="mail@mail.com" value="{{old('email')}}">
                        @error('email')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Kata Sandi  <span class="text-danger">*</span></label>
                        <input type="password" class="form-control" id="password" name="password" autocomplete="off"
                            placeholder="Masukkan Kata Sandi"  >
                            @error('password')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Konfirmasi Kata Sandi <span class="text-danger">*</span></label>
                        <input type="password" name="password_confirmation" class="form-control" placeholder="masukkan kata sandi sebelumnya"  required>
                        @error('password_confirmation')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                    </div>
                    {{-- <div class="row col-md-10">
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Tempat
                                    Lahir <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir"
                                    autocomplete="off" placeholder=" Masukkan Tempat Lahir" value="{{old('tempat_lahir')}}"
                                    placeholder="Masukkan tempat lahir" >
                                    @error('tempat_lahir')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-7">
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Tanggal
                                    Lahir <span class="text-danger">*</span></label>
                                <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir"
                                    autocomplete="off" placeholder="masukkan tanggal lahir" value="{{old('tanggal_lahir')}}">
                                    @error('tanggal_lahir')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Kecamatan <span class="text-danger">*</span></label>
                        <select class="form-select" name="id_kecamatan" id="id_kecamatan" data-width="100%">
                            <option class="mb-2" value=" ">---Pilih Kecamatan---</option>
                            @foreach(\App\Models\Kecamatan::orderBy('nama','asc')->get() as
                            $value => $key)

                            <option value="{{$key->id}}">{{$key->nama}}</option>
                            @endforeach
                        </select>
                    </div>


                    <div class="mb-3">
                        <label class="form-label">Kelurahan <span class="text-danger">*</span></label>
                        <select class="form-select" name="id_kelurahan" data-width="100%" id="id_desa">

                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Alamat <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="alamat" name="alamat" autocomplete="off"
                            placeholder="Masukkan Alamat" value="{{old('alamat')}}">
                            @error('alamat')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Pendidikan <span class="text-danger">*</span></label>
                        <select class="form-select" name="pendidikan" id="pendidikan" data-width="100%" required>
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
                    </div> --}}
                    <div class="text-end mt-4">
                        <button type="submit" class="btn btn-primary mt-0">Tambah</button>
                        <a href="{{URL::previous()}}" type="button" class="btn btn-secondary">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

{{-- @push('after-script')
<script type="text/javascript">
    $(document).ready(function () {

        $('#id_kecamatan').select2()
        $('#id_desa').select2()
        $("#id_desa").append('<option value="" >---Pilih Kelurahan---</option>')
        $("#id_desa").prop('disabled', true)
        
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
    });

</script> @endpush --}}
