@extends('layout.master')
@section('title') Data Pasien @endsection
@section('navbar-title') Pasien @endsection
@section('content')

<div class="row">
    <div class="d-md-none">&nbsp;</div>
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h6 class="text-center h3 my-4">Tambah Pasien</h6>
                <form action="{{ route('anak.store') }}" class="forms-sample" id="anak-store" method="post"
                    nctype="multipart/form-data" files=true>
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Nama Dokter <span class="text-danger">*</span></label>
                        <select class="js-example-basic-single form-select" name="dokter" data-width="100%">
                            @foreach(\App\Models\Dokter::get() as $value => $key)

                            <option value="{{$key->id}}">{{$key->nama}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Nama <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="nama" name="nama" autocomplete="off"
                            placeholder="Masukkan Nama" value="{{old('nama')}}" required>
                            @error('nama')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Nama orangtua  <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="nama_orangtua" name="nama_orangtua"
                                    autocomplete="off" placeholder="nama orangtua" value="{{old('nama_orangtua')}}" required>
                            </div>

                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Nomor Whatsapp</label>
                                <input type="text" class="form-control" id="no_whatsapp" name="no_whatsapp"
                                    autocomplete="off" placeholder="nomor whatsapp" value="{{old('no_whatsapps')}}" >
                        </div>
                    {{--<div class="mb-3">
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
                        @error('jenis_kelamin')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
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

@push('after-script')

{{-- <script type="text/javascript">
    $(document).ready(function () {
        /* save data */
        $('#dokter-store').on('submit', function (e) {
            e.preventDefault();
            $.ajax({
                'type': 'POST',
                'url': "{{ route('dokter.store') }}",
'data': new FormData(this),
'processData': false,
'contentType': false,
'dataType': 'JSON',
'success': function (data) {
if (data.success) {
window.location.href = "/dokter"
} else {
for (var count = 0; count < data.errors.length; count++) { swal(data.errors[count], { icon: "error" , timer: false, });
    } } }, }); }); }); </script> --}} @endpush
