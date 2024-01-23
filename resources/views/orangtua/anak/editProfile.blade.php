@extends('layout.master')

@section('content')

<div class="card shadow px-3 py-1 mb-3">
    <div class="row">
        <div class="col-md-6 col-sm-6">
            <!-- Tidak ada elemen disini -->
        </div>
        <div class="col-md-6 col-sm-6 d-flex justify-content-end mt-4">
            <button href="#" type="button" id="btn-create" class="btn btn-submit-col btn-rounded" style="margin-right: 15px;" onclick="cetakQR()">
                <i class="fas fa-qrcode" style="margin: 0px 10px;"></i>
                Cetak QR
            </button>
        </div>
    </div>

    <form action="{{ route('orangtua-anak.update',$anak->id) }}" id="form-anak" class="forms-sample py-4 px-3" method="post" enctype="multipart/form-data" files=true>
    <h6 class="text-left h4 mb-3">Data Pasien</h6>
        <input type="hidden" id="id" value="{{$anak->id}}">
        @csrf
        @method('PUT')


        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label @error('nama') is-invalid @enderror">Nama <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="nama" name="nama" autocomplete="off" value="{{$anak->nama}}" placeholder="Nama">
            @error('nama')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="col-md-12 col-sm-12 mb-2"> Jenis Kelamin <span class="text-danger">*</span></label>
            <div class="form-check form-check-inline">
                <input type="radio" class="form-check-input" value="laki-laki" name="jenis_kelamin" id="radioInline" {{ ($anak->jenis_kelamin=="laki-laki")? "checked" : "" }}>
                <label class="form-check-label" for="radioInline">
                    Laki-Laki
                </label>
            </div>
            <div class="form-check form-check-inline">
                <input type="radio" value="perempuan" class="form-check-input" name="jenis_kelamin" id="radioInline1" {{ ($anak->jenis_kelamin=="perempuan")? "checked" : "" }}>
                <label class="form-check-label" for="radioInline1">
                    Perempuan
                </label>
            </div>
        </div>

        <div class="row col-md-10">

            <div class="col-md-6">
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Nomor Whatsapp <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('no_whatsapp') is-invalid @enderror" id="no_whatsapp" name="no_whatsapp" autocomplete="off" placeholder="nomor whatsapp" value="{{$anak->no_whatsapp}}">
                    @error('no_whatsapp')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Tanggal Lahir <span class="text-danger">*</span></label>
                    <input type="date" class="form-control @error('tanggal_lahir') is-invalid @enderror" id="tanggal_lahir" name="tanggal_lahir" autocomplete="off" placeholder="masukkan tanggal lahir" value="{{$anak->tanggal_lahir ? $anak->tanggal_lahir->format('Y-m-d') : ''}}" max="{{ date('Y-m-d') }}">
                    @error('tanggal_lahir')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>
        <div style="float:right">
            <button  type="submit" id="btn-create" class="btn btn-submit-col btn-rounded">
                Simpan Profil
            </button>
            <a href="{{URL::previous()}}" type="button" class="btn btn-submit-col mt-3">Batal</a>
        </div>

    </form>
</div>

<script>
    function cetakQR() {
    var id = document.getElementById('id').value;
    var nama = document.getElementById('nama').value;
    var jenisKelamin = document.querySelector('input[name="jenis_kelamin"]:checked').value;
    var tanggalLahir = document.getElementById('tanggal_lahir').value;

    var anakData = [{
        id: id,
        nama: nama,
        jenis_kelamin: jenisKelamin,
        tanggal_lahir: tanggalLahir
    }];

    var dataInJson = JSON.stringify(anakData);
    var url = "/orangtua/cetakQR?data=" + encodeURIComponent(dataInJson);
    // window.location.href = url;
    window.open(url)
}
</script>


@endsection
