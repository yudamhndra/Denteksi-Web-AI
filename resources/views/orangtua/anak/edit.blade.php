@extends('layout.master')

@section('content')


{{--
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
            <a href="#save" type="button" id="btn-create" class="btn btn-submit-col btn-rounded">
                <i class="fas fa-pencil-alt" style="margin: 0px 10px;"></i>
                Edit Anak
            </a>
        </div>
    </div>

    <h6 class="text-left h4 mb-3">Data Anak</h6>
    <form action="{{ route('orangtua-anak.update',$anak->id) }}" id="form-anak" class="forms-sample" method="post" enctype="multipart/form-data" files=true>
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
                    <label for="exampleInputPassword1" class="form-label">Tempat Lahir <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('tempat_lahir') is-invalid @enderror" id="tempat_lahir" name="tempat_lahir" autocomplete="off" placeholder="Tempat Lahir" value="{{$anak->tempat_lahir}}">
                    @error('tempat_lahir')
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
        <!-- <div style="float:right">
                <button type="submit" class="btn btn-primary me-2">Simpan</button>
                <a href="{{URL::previous()}}" type="button" class="btn btn-secondary">Batal</a>
            </div> -->
    </form>
</div>

--}}

<div class="card shadow px-3 py-1 mb-4">
    <div class="card-body">
        <div class="row">
            <div class="col-md-6 col-sm-12 align-self-center">
                <div class="d-md-block d-none">
                    <h1 class="mb-3 mb-md-0 text-left">Unggah Foto Gigi</h1>
                    <h1 class="mb-3 mb-md-0 text-left">Untuk Pemeriksaan</h1>
                    <a type="button" href="{{ route('orangtua-anak.pemeriksaan', ['id' => $anak->id]) }}" class="btn btn-primary wd-350 mt-3 button">UNGGAH SEKARANG</a>
                </div>
                <div class="d-md-none text-center"> <!-- Tampilan Mobile -->
                    <img class="wd-250 ht-250" src="{{asset('assets/images/image_uploadGigi.png')}}" alt="Senyumin" class="img-fluid">
                    <h2 class="mb-3 mb-md-0 text-center">Unggah Foto Gigi Untuk Pemeriksaan</h2>
                    <a type="button" href="{{ route('orangtua-anak.pemeriksaan', ['id' => $anak->id]) }}" class="btn btn-primary wd-200 mt-3 button text-center">UNGGAH SEKARANG</a>
                </div>
            </div>
            <div class="col-md-6 d-none d-md-block text-center">
                <img class="wd-400 ht-400" src="{{asset('assets/images/image_uploadGigi.png')}}" alt="Senyumin" class="img-fluid">
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="card shadow px-3 py-1 mb-4">
                <div class="card-body">
                    <h3 class="mb-3 mb-md-0">RIWAYAT PEMERIKSAAN</h3>
                    <div class="table table-responsive">
                        <table id="table-anak" class="table">
                            <thead>
                                <tr>
                                    <th>Waktu Periksa</th>
                                    <th>Status</th>
                                    <th>Rekomendasi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Isi tabel -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow px-3 py-1 mb-4">
                <div class="card-body">
                    <h3 class="mb-3 mb-md-0 text-center">HASIL PEMERIKSAAN</h3>
                    <h3 class="mb-3 mb-md-0 text-center">TERAKHIR</h3>
                    <div class="status mb-2 mt-5">
                        <h4>Status</h4>
                        <div class="d-flex justify-content-center mt-2">
                            <div class="status-button" id="status-button">
                                <span id="status-text">Belum Divalidasi</span>
                            </div>
                        </div>
                    </div>
                    <div class="status mt-5">
                        <h4>Rekomendasi</h4>
                        <div class="d-flex justify-content-center mt-2">
                            <div class="status-button-white" id="status-button-white">
                                <span id="status-text">Belum Ada</span>
                            </div>
                        </div>
                    </div>
                    <div class="text-center" style="margin-top: 8rem;">
                        <a type="button" href="#Lihat-Hasil" class="btn btn-primary wd-200 mt-3 button">
                            Lihat Hasil
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('after-script')
<script type="text/javascript">
    function cetakQR() {
    var selectedDataToSend = [{
        id: <?php echo $anak->id; ?>,
        nama: '<?php echo $anak->nama; ?>',
    }];
    var dataInJson = JSON.stringify(selectedDataToSend);
    var url = "/orangtua/cetakQR?data=" + encodeURIComponent(dataInJson);
    window.location.href = url;
    };

    $(document).ready(function () {

        $('#tempat_lahir,#nama').on('input', function () {
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

        $("#form-anak").validate({
            rules: {
                nama: "required",
                tempat_lahir:"required",
                tanggal_lahir:"required",
                jenis_kelamin:"required",




            },
            messages: {
                nama: "Nama wajib diisi",
                tempat_lahir: "Tempat lahir wajib diisi",
                tanggal_lahir: "Tanggal lahir wajib diisi",
                jenis_kelamin: "Jenis kelamin wajib diisi",




            },
            errorPlacement: function(error, element) {
                if (element.attr("name") == "jenis_kelamin") {
                    error.appendTo(element.parents('.gender').find('.error-placement'));
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
@endpush
