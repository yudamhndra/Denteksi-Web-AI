@extends('layout.master')

@section('content')

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="text-center h3">Tambah Anak</h6>
                    <form action="{{ route('anak.store') }}" class="forms-sample" id="anak-store" method="post"
                          nctype="multipart/form-data" files=true>
                        @csrf

                        <div class="mb-3">
                            <label class="form-label">Nama Orangtua <span class="text-danger">*</span></label>
                            <select class="js-example-basic-single form-select" name="orangtua" data-width="100%">
                                @foreach(\App\Models\Orangtua::get() as $value => $key)

                                    <option value="{{$key->id}}">{{$key->nama}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Nama <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="nama" name="nama" autocomplete="off"
                                   placeholder="Masukkan Nama">
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
                        <div class="row col-md-10">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="exampleInputPassword1" class="form-label">Tempat
                                        Lahir <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir"
                                           autocomplete="off" placeholder="Masukkan Tempat Lahir">
                                </div>
                            </div>
                            <div class="col-md-7">
                                <div class="mb-3">
                                    <label for="exampleInputPassword1" class="form-label">Tanggal
                                        Lahir <span class="text-danger">*</span></label>
                                    <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir"
                                           autocomplete="off" placeholder="Masukkan tanggal lahir">
                                </div>
                            </div>
                        </div>


                        <div style="float: right">
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
