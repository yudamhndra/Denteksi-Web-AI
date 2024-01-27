@extends('layout.master')
@section('content')



<div class="card shadow p-3">
    <div class="card-body">
        <input type="hidden" id="id_periksa" value="{{$periksa->id}}">
        {{-- <input type="hidden" id="id" value="{{$anak->id}}"> --}}
            @csrf

            <div class="row mt-5">
                <div class="col-md-6 align-self-center">
                    <h5 class="mb-3 mb-md-0 text-left">HASIL PEMERIKSAAN</h5>
                </div>
            </div>

            <div class="container">
                <div class="row justify-content-center align-items-end">
                    <div class="col-md-6 col-lg-4 mb-4 text-center">
                        <div class="card text-center custom-card shadow mx-auto">
                            <div class="card-body">
                                <img id="gigi-depan-asli" src="{{'/storage/gigi/'.$periksa->gambar1}}" class="img-fluid mt-3" style="max-width: 100%;" alt="Foto belum diambil">
                            </div>
                        </div>
                        <p class="mt-3">Foto gigi asli</p>
                    </div>
                    <div class="col-md-6 col-lg-4 mb-4 text-center">
                        <div class="card text-center custom-card shadow mx-auto">
                            <div class="card-body">
                                <img id="gigi-depan" src="data:image/jpeg;base64,{{ base64_encode($decodedImage) }}" class="img-fluid" style="max-width: 100%;" alt="{{$url}}" val>
                            </div>
                        </div>
                        <p class="mt-3">hasil deteksi ai</p>
                    </div>
                </div>
            </div>

                        <div class="row col-md-12 mt-3 px-5">
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Nama </label>
                                <input type="text" disabled class="form-control" id="nama" name="nama"
                                    autocomplete="off" placeholder="masukkan nama" value="{{$pasien->nama}}">
                            </div>
                        </div>



            <!-- <div class="row col-md-12 mt-2 px-5"> -->
                    {{--    <div class="col-md-6">
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Tanggal Lahir </label>
                                <input type="type" disabled class="form-control @error('tanggal_lahir') is-invalid @enderror" id="tanggal_lahir" name="tanggal_lahir"
                                    autocomplete="off" placeholder="masukkan tanggal lahir"value="{{$pasien->tanggal_lahir}}" >
                            </div>
                        </div> --}}
                        <div class="row col-md-12 mt-2 px-5">
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label is-invalid">Nama Orangtua </label>
                                <input type="text" class="form-control" id="nama_orangtua" name="nama_orangtua" autocomplete="off" disabled value="{{$pasien->nama_orangtua}}" placeholder="Nama orangtua">
                            </div>
                        </div>
                        <div class="row col-md-12 mt-2 px-5">
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Nomor Whatsapp </label>
                                <input type="text" disabled class="form-control @error('no_whatsapp') is-invalid @enderror" id="no_whatsapp" name="no_whatsapp"
                                    autocomplete="off" placeholder="nomor whatsapp" value="{{$pasien->no_whatsapp}}">
                            </div>
                        </div>
            <!-- </div> -->

                     <div class="row col-md-12 px-5">
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Hasil Pemeriksaan </label>
                                <input type="text" class="form-control" id="hasil" name="hasil"
                                    autocomplete="off" disabled placeholder="hasil belum keluar" value="{{$skrining->diagnosa}}">
                            </div>
                        </div>

                        <div class="row col-md-12 px-5">
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Rekomendasi </label>
                                <input type="text" disabled class="form-control" id="rekomendasi" name="rekomendasi"
                                    autocomplete="off" placeholder="belum ada rekomendasi"  value="{{$skrining->rekomendasi}}">
                            </div>
                        </div>


            <div class="d-flex justify-content-end mt-5">
                <a href="{{Route('view-riwayat')}}" class="btn btn-cancel wd-100 mt-3 button ml-auto" id="btn-cancel">
                    Kembali
                </a>
                <a type="button" onclick="cetakPdf()" target="_self" class="btn btn-primary wd-150 mt-3 button ml-2" style="margin-left: 10px;" id="btn-periksa"> <i class="fas fa-file" style="margin-right: 10px;"></i>
                    Cetak Hasil
                </a>
            </div>
    </div>
</div>

@endsection

@push('after-script')
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script> -->
<script type="text/javascript">

    function cetakPdf() {
        var nama = document.getElementById('nama').value;
        var no_whatsapp = document.getElementById('no_whatsapp').value;
        var hasil = document.getElementById('hasil').value;
        var rekomendasi = document.getElementById('rekomendasi').value;
        var gambar = document.getElementById('gigi-depan-asli').src;
        var id_periksa = document.getElementById('id_periksa').value
        var nama_orangtua =  document.getElementById('nama_orangtua').value


        var selectedDataToSend = [{
                id : id_periksa,
                gambar: gambar,
            }];

        var dataInJson = JSON.stringify(selectedDataToSend);
        // var url = "/orangtua/dashboard"
        var url = "/orangtua/get-pdf-result?data=" + encodeURIComponent(dataInJson);
        // window.location.href = url;
        window.open(url, '_self');
    }

    </script>
@endpush
