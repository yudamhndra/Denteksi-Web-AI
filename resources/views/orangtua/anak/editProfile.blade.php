@extends('layout.master')
@section('title') edit @endsection

@section('content')

<div class="card shadow px-3 py-1 mb-3">
    <div class="row">
      {{--  <!-- <div class="col-md-6 col-sm-6"> -->
            <!-- Tidak ada elemen disini -->
        <!-- </div>
        <div class="col-md-6 col-sm-6 d-flex justify-content-end mt-4">
            <button href="#" type="button" id="btn-create" class="btn btn-submit-col btn-rounded" style="margin-right: 15px;" onclick="cetakQR()">
                <i class="fas fa-qrcode" style="margin: 0px 10px;"></i>
                Cetak QR
            </button>
        </div> --> --}}
    </div>

    <form action="{{ route('orangtua-anak.update',$pasien->id) }}" id="form-anak" class="forms-sample py-4 px-3" method="post" enctype="multipart/form-data" files=true>
    <h6 class="text-left mt-3 h4 mb-3">Data Pasien</h6>
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

    {{--    <div class="mb-3">
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
        </div> --}}

        <div class=" col-md-10">

                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Nomor Whatsapp <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('no_whatsapp') is-invalid @enderror" id="no_whatsapp" name="no_whatsapp" autocomplete="off" placeholder="nomor whatsapp" value="{{$pasien->no_whatsapp}}">
                    @error('no_whatsapp')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

       {{--     <div class="col-md-6">
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Tanggal Lahir <span class="text-danger">*</span></label>
                    <input type="date" class="form-control @error('tanggal_lahir') is-invalid @enderror" id="tanggal_lahir" name="tanggal_lahir" autocomplete="off" placeholder="masukkan tanggal lahir" value="{{$pasien->tanggal_lahir ? $pasien->tanggal_lahir->format('Y-m-d') : ''}}" max="{{ date('Y-m-d') }}">
                    @error('tanggal_lahir')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div> --}}
                    <div class="row mt-3">
                        <h5 class="mb-3 mb-md-0 text-left">FOTO PASIEN</h5>
                    </div>
                    <div class="row">
                        <div class="row col-md-8 mt-2 mx-auto">
                            <div class="card text-center custom-card shadow py-2">
                                <div class="card-body">
                                    <div class="row mt-3">
                                        <h6 class="mb-3 mb-md-0 text-left">PREVIEW</h6>
                                    </div>
                                    @if($periksa->gambar1 == null)
                                    <img id="gigi-depan"  src="{{ asset('assets/images/take-a-pict.png') }}" class="img-fluid mt-3"  alt="foto belum diambil">
                                    @else
                                    <img id="gigi-depan"  src="{{'/storage/gigi/'.$periksa->gambar1}}" class="img-fluid mt-3"alt="foto belum diambil">
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-3">
                        <h5 class="mb-3 mb-md-0 text-left">GANTI FOTO</h5>
                </div>
                    <div class="row mt-2">
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Foto gigi dari sisi depan</label>
                            <input type="file"  class="form-control dropify"  data-show-loader="true" data-allowed-file-extensions="jpg png jpeg svg" id="gambar1" name="gambar1" placeholder="masukkan gambar">
                            @error('gambar1')
                            <div class="badge bg-danger mt-2 ">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

        <div class="d-flex justify-content-end mt-5">
            <a href="{{URL::previous()}}" type="button" class="btn btn-cancel wd-100 mt-3 button ml-auto" id="btn-cancel">
                Batal
            </a>
            <button type="submit" class="btn btn-primary wd-150 mt-3 button ml-2" style="margin-left: 10px;" id="btn-periksa">
                Periksa Sekarang
            </button>
        </div>
    
    </form>
</div>


@endsection

@push('after-script')

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

    $(document).ready(function () {

        $('.dropify').dropify({
                messages: {
                    'default': 'Drag and drop a file here or click',
                    'replace': 'Drag and drop or click to replace',
                    'remove':  'Hapus',

                },
                error: {

                    'imageFormat': 'Format yang diizinkan hanya jpg , jpeg, png , dan svg.'
                }
            });


        });

</script>

@endpush
