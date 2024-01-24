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

    <form action="{{ route('orangtua-anak.update',$pasien->id) }}" id="form-anak" class="forms-sample py-4 px-3" method="post" enctype="multipart/form-data" files=true>
    <h6 class="text-left h4 mb-3">Data Pasien</h6>
        <input type="hidden" id="id" value="{{$pasien->id}}">
        @csrf
        @method('PUT')


        <div class="mb-3 col-md-10">
            <label for="exampleInputPassword1" class="form-label @error('nama') is-invalid @enderror">Nama <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="nama" name="nama" autocomplete="off" value="{{$pasien->nama}}" placeholder="Nama">
            @error('nama')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="col-md-12 col-sm-12 mb-2"> Jenis Kelamin <span class="text-danger">*</span></label>
            <div class="form-check form-check-inline">
                <input type="radio" class="form-check-input" value="laki-laki" name="jenis_kelamin" id="radioInline" {{ ($pasien->jenis_kelamin=="laki-laki")? "checked" : "" }}>
                <label class="form-check-label" for="radioInline">
                    Laki-Laki
                </label>
            </div>
            <div class="form-check form-check-inline">
                <input type="radio" value="perempuan" class="form-check-input" name="jenis_kelamin" id="radioInline1" {{ ($pasien->jenis_kelamin=="perempuan")? "checked" : "" }}>
                <label class="form-check-label" for="radioInline1">
                    Perempuan
                </label>
            </div>
        </div>

        <div class="row col-md-10">

            <div class="col-md-6">
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Nomor Whatsapp <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('no_whatsapp') is-invalid @enderror" id="no_whatsapp" name="no_whatsapp" autocomplete="off" placeholder="nomor whatsapp" value="{{$pasien->no_whatsapp}}">
                    @error('no_whatsapp')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Tanggal Lahir <span class="text-danger">*</span></label>
                    <input type="date" class="form-control @error('tanggal_lahir') is-invalid @enderror" id="tanggal_lahir" name="tanggal_lahir" autocomplete="off" placeholder="masukkan tanggal lahir" value="{{$pasien->tanggal_lahir ? $pasien->tanggal_lahir->format('Y-m-d') : ''}}" max="{{ date('Y-m-d') }}">
                    @error('tanggal_lahir')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="row mt-3">
                        <h5 class="mb-3 mb-md-0 text-left">TAMBAH FOTO</h5>
                    </div>

                    <div class="row">
                        <div class="row col-md-8 mt-5 mx-auto">
                            <div class="card text-center custom-card shadow py-2">
                                <div class="card-body">
                                    <div class="row mt-3">
                                        <h6 class="mb-3 mb-md-0 text-left">PREVIEW</h6>
                                    </div>
                                    @if($periksa == null)
                                    <img id="gigi-depan"  src="{{ asset('assets/images/take-a-pict.png') }}" class="img-fluid mt-3" style="width: 400px; height: 200px;" alt="foto belum diambil">
                                    @else
                                    <img id="gigi-depan"  src="{{'/storage/gigi/'.$periksa->gambar1}}" class="img-fluid mt-3" style="width: 400px; height: 200px;" alt="foto belum diambil">
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-5">
                        <div class="row col-md-5 mb-3 mx-auto">
                            <button type="button" class="btn-create btn btn-submit-col" id="btn-use-camera"> GUNAKAN KAMERA</button>
                            <p class="text-center">atau</p>
                        <label for="fileInput" class="btn btn-submit-white mt-1">
                            <i class="far fa-image"></i> AMBIL DARI GALERI
                            <input id="fileInput" onchange="readURL(this, 'gigi-depan');" type="file" name="gambar1" accept="image/*" style="display: none;">
                        </label>
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

<script type="text/javascript">
    function cetakQR() {
    var id = document.getElementById('id').value;
    var nama = document.getElementById('nama').value;
    var jenisKelamin = document.querySelector('input[name="jenis_kelamin"]:checked').value;
    var tanggalLahir = document.getElementById('tanggal_lahir').value;
    var whatsapp = document.getElementById('no_whatsapp').value;

    var anakData = [{
        id: id,
        nama: nama,
        jenis_kelamin: jenisKelamin,
        tanggal: tanggalLahir,
        whatsapp: whatsapp
    }];

    var dataInJson = JSON.stringify(anakData);
    var url = "/orangtua/cetakQR?data=" + encodeURIComponent(dataInJson);
    // window.location.href = url;
    window.open(url)
}


function ambilDariGaleri() {
        // Membuat input file
        var inputFile = document.createElement('input');
        inputFile.type = 'file';
        inputFile.accept = 'image/*';
        inputFile.style.display = 'none';
        inputFile.name = 'gambar1'

        // Menambahkan event listener untuk perubahan input file
        inputFile.addEventListener('change', function (event) {
            var file = event.target.files[0];

            // Membaca file gambar menggunakan FileReader
            var reader = new FileReader();
            reader.onload = function (e) {
                // Menampilkan pratinjau gambar
                $('#gigi-depan').attr('src', e.target.result);
            };
            reader.readAsDataURL(file);
        });

        // Menambahkan input file ke dalam dokumen dan memicu klik
        document.body.appendChild(inputFile);
        inputFile.click();

        // Menghapus input file setelah digunakan
        document.body.removeChild(inputFile);
    }

    function readURL(input, imageId) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#' + imageId).attr('src', e.target.result);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

</script>


@endsection
