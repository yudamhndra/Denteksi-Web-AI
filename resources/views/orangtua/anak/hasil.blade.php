@extends('layout.master')
@section('content')



<div class="card shadow p-3">
    <div class="card-body">
        <input type="hidden" id="id" value="{{$anak->id}}">
            @csrf

            <div class="row mt-5">
                <div class="col-md-6 align-self-center">
                    <h5 class="mb-3 mb-md-0 text-left">HASIL PEMERIKSAAN</h5>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4 mt-5 mx-auto">
                    <div class="card text-center custom-card shadow w-100 py-2">
                        <div class="card-body">
                            @if(!empty($decodedImage))
                                <img src="data:image/jpeg;base64,{{ base64_encode($decodedImage) }}" class="img-fluid" style="width: 200px; height: 200px;" alt="Image">
                            @endif
                        </div>
                    </div>
                </div>
            </div>



                        <div class="row col-md-12 mt-3 px-5">
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Nama </label>
                                <input type="text" disabled class="form-control" id="nama" name="nama"
                                    autocomplete="off" placeholder="masukkan nama" value="{{$anak->nama}}">
                            </div>
                        </div>



            <div class="row col-md-12 mt-2 px-5">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Tanggal Lahir </label>
                                <input type="type" disabled class="form-control @error('tanggal_lahir') is-invalid @enderror" id="tanggal_lahir" name="tanggal_lahir"
                                    autocomplete="off" placeholder="masukkan tanggal lahir"value="{{$anak->tanggal_lahir}}" >
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Nomor Whatsapp </label>
                                <input type="text" disabled class="form-control @error('no_whatsapp') is-invalid @enderror" id="no_whatsapp" name="no_whatsapp"
                                    autocomplete="off" placeholder="masukkan nomor whatsapp" value="{{$anak->no_whatsapp}}">
                            </div>
                        </div>
            </div>

            <div class="row col-md-12 px-5">
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Hasil Pemeriksaan </label>
                                <input type="text" class="form-control" id="hasil" name="hasil"
                                    autocomplete="off" disabled placeholder="hasil belum keluar" value="{{old('hasil')}}">
                            </div>
                        </div>

                        <div class="row col-md-12 px-5">
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Rekomendasi </label>
                                <input type="text" disabled class="form-control" id="rekomendasi" name="rekomendasi"
                                    autocomplete="off" placeholder="belum ada rekomendasi" value="{{old('rekomendasi')}}">
                            </div>
                        </div>


            <div class="d-flex justify-content-end mt-5">
                <a href="{{Route('view-riwayat')}}" class="btn btn-cancel wd-100 mt-3 button ml-auto" id="btn-cancel">
                    Kembali
                </a>
                <a type="button" href="{{route('pdfResult')}}" onclick="cetakPdf()" target="_blank" class="btn btn-primary wd-150 mt-3 button ml-2" style="margin-left: 10px;" id="btn-periksa"> <i class="fas fa-file" style="margin-right: 10px;"></i>
                    Cetak Hasil
                </a>
            </div>
    </div>
</div>

@endsection

@push('after-script')
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script> -->
<script type="text/javascript">

    var nama = document.getElementById('nama').value
    var tanggal_lahir = document.getElementById('tanggal_lahir').value
    var no_whatsapp = document.getElementById('no_whatsapp').value
    var hasil = document.getElementById('hasil').value
    var rekomendasi = document.getElementById('rekomendasi').value

    var selectedDataToSend = [{
            nama: nama,
            tanggal: tanggal_lahir,
            whatsapp: no_whatsapp,
            hasil: hasil,
            rekomendasi: rekomendasi
        }];

    var dataInJson = JSON.stringify(selectedDataToSend);
    var url = "/orangtua/cetakResult?data=" + encodeURIComponent(dataInJson);
    // window.location.href = url;
    window.open(url)
</script>
@endpush
