@extends('layout.master')

@section('content')
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Rekap Data Pasien</a></li>
            <li class="breadcrumb-item active" aria-current="page">Detail</li>
        </ol>
    </nav>
    <div class="card text-white bg-primary">
    <div class="card-body">
        <div class="row align-items-center">
            <div class="col-md-auto">
                <i data-feather="arrow-left-circle"></i>
            </div>
            <div class="col">
                <table class="table table-borderless table-sm">
                    <thead>
                        <tr style="color: white; line-height: 14px;">
                            <td>
                                <h3><b>Oman</b></h3>
                            </td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr style="color: white; line-height: 5px; font-size:small">
                            <td>nama</td>
                            <td>jenis kelamin</td>
                            <td>nama posyandu</td>
                            <td>TTL</td>
                            <td>usia anak</td>
                        </tr>
                        <tr style="color: white; line-height: 10px; font-size:larger;">
                            <td>Oman</td>
                            <td>Laki-laki</td>
                            <td>Seruni</td>
                            <td>Bekasi, 14 Agustus 2002</td>
                            <td>17 Tahun</td>
                        </tr>
                    </tbody>
                </table>
                </div>
            <div class="col-md-auto">
                <i data-feather="arrow-right-circle"></i>
            </div>
        </div>
    </div>
</div>
<br>
<div class="row">
    <div class= "col-md-4" ><hr></div>
    <div class= "col-md-4" ><h5><span class="badge rounded-pill bg-secondary px-7 py-2">Grafik</span></h5></div>
    <div class= "col-md-4" ><hr></div>
</div>
<br>
<div class="row">
    <div class="col-xl-6 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title">Grafik Tinggi Badan Anak</h6>
                <div class="flot-chart-wrapper">
                    <div class="flot-chart" id="flotLine"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-6 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title">Grafik Berat Badan Anak</h6>
                <div class="flot-chart-wrapper">
                    <div class="flot-chart" id="flotLine2"></div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class= "col-md-4" ><hr></div>
    <div class= "col-md-4" ><h5><span class="badge rounded-pill bg-secondary px-6 py-2 content-center">Pemeriksaan Tahun (Tahun 2022)</span></h5></div>
    <div class= "col-md-4" ><hr></div>
</div>
<br>
<div class="card">
    <div class="card-body">
        <h6 class="card-title">PEMERIKSAAN FISIK</h6>
        <p class="text-muted mb-3">(19/02/2022)</p>
        <form class="forms-sample">
            <div class="row">
                <div class="col-md-6">
                    <div class="row mb-3">
                        <label for="exampleInputMobile" class="col-sm-3 col-form-label">Tinggi badan (cm)</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="exampleInputMobile" placeholder="Tinggi badan">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="exampleInputMobile" class="col-sm-3 col-form-label">Berat badan (kg)</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="exampleInputMobile" placeholder="Berat badan">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="exampleInputMobile" class="col-sm-3 col-form-label">IMT (kg/m2)</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="exampleInputMobile" placeholder="IMT">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="exampleInputMobile" class="col-sm-3 col-form-label">Sistole (mmHg)</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="exampleInputMobile" placeholder="Sistole">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="exampleInputMobile" class="col-sm-3 col-form-label">Diastole (mmHg)</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="exampleInputMobile" placeholder="Diastole">
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <h6>HASIL :</h6>
                    <button type="button" class="btn btn-success btn-lg mb-3"><b>IDEAL</b></button>
                    <h6>REKOMENDASI :</h6>
                    <p>-</p>
                </div>
            </div>
        </form>
    </div>
</div>
<br>
<div class="card">
    <div class="card-body">
        <h6 class="card-title">PEMERIKSAAN MATA</h6>
        <p class="text-muted mb-3">(19/02/2022)</p>
        <form class="forms-sample">
            <div class="row">
                <div class="col-md-6">
                    <div class="row sm-1">
                        <div class="sm-1">
                            <label for="exampleInputMobile" class="col-sm-8 col-form-label">
                                Mata perih/merah dan bengkak
                            </label>
                            <div class="form-check form-check-inline">
                                <input type="radio" class="form-check-input" name="radioInline" id="radioInline">
                                <label class="form-check-label" for="radioInline">
                                    Ya
                                </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input type="radio" class="form-check-input" name="radioInline" id="radioInline1">
                                <label class="form-check-label" for="radioInline1">
                                    Tidak
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="row sm-1">
                        <div class="sm-1">
                            <label for="exampleInputMobile" class="col-sm-8 col-form-label">
                                Tidak dapat membaca/melihat dengan jelas
                            </label>
                            <div class="form-check form-check-inline">
                                <input type="radio" class="form-check-input" name="radioInline2" id="radioInline">
                                <label class="form-check-label" for="radioInline">
                                    Ya
                                </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input type="radio" class="form-check-input" name="radioInline2" id="radioInline1">
                                <label class="form-check-label" for="radioInline1">
                                    Tidak
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="row sm-1">
                        <div class="sm-1">
                            <label for="exampleInputMobile" class="col-sm-8 col-form-label">
                                Menggunakan kacamata
                            </label>
                            <div class="form-check form-check-inline">
                                <input type="radio" class="form-check-input" name="radioInline3" id="radioInline">
                                <label class="form-check-label" for="radioInline">
                                    Ya
                                </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input type="radio" class="form-check-input" name="radioInline3" id="radioInline1">
                                <label class="form-check-label" for="radioInline1">
                                    Tidak
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="row sm-1">
                        <div class="sm-1">
                            <label for="exampleInputMobile" class="col-sm-8 col-form-label">
                                Mata juling
                            </label>
                            <div class="form-check form-check-inline">
                                <input type="radio" class="form-check-input" name="radioInline4" id="radioInline">
                                <label class="form-check-label" for="radioInline">
                                    Ya
                                </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input type="radio" class="form-check-input" name="radioInline4" id="radioInline1">
                                <label class="form-check-label" for="radioInline1">
                                    Tidak
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="row sm-1">
                        <div class="sm-1">
                            <label for="exampleInputMobile" class="col-sm-8 col-form-label">
                                Tidak dapat membedakan warna dengan baik
                            </label>
                            <div class="form-check form-check-inline">
                                <input type="radio" class="form-check-input" name="radioInline5" id="radioInline">
                                <label class="form-check-label" for="radioInline">
                                    Ya
                                </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input type="radio" class="form-check-input" name="radioInline5" id="radioInline1">
                                <label class="form-check-label" for="radioInline1">
                                    Tidak
                                </label>
                            </div>
                        </div>
                    </div>
                </div> 
                <div class="col-md-6">
                    <h6>HASIL :</h6>
                    <div class="btn-group btn-group-lg mb-3" role="group" aria-label="Basic example">
                        <button type="button" class="btn btn-danger"><b>
                            MATA MINUS
                        </b></button>
                        <a class="btn btn-icon btn-danger" href="#" role="button">
                            <i data-feather="edit-2"></i>
                        </a>
                    </div>
                    <h6>REKOMENDASI :</h6>
                    <p>-</p>
                </div> 
            </div> 
        </form>
    </div>
</div>
<br>
<div class="card">
    <div class="card-body">
        <h6 class="card-title">PEMERIKSAAN TELINGA</h6>
        <p class="text-muted mb-3">(19/02/2022)</p>
        <form class="forms-sample">
            <div class="row">
                <div class="col-md-6">
                    <div class="row sm-1">
                        <div class="sm-1">
                            <label for="exampleInputMobile" class="col-sm-8 col-form-label">
                                Tidak merespon bila ada suara keras
                            </label>
                            <div class="form-check form-check-inline">
                                <input type="radio" class="form-check-input" name="radioInline" id="radioInline">
                                <label class="form-check-label" for="radioInline">
                                    Ya
                                </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input type="radio" class="form-check-input" name="radioInline" id="radioInline1">
                                <label class="form-check-label" for="radioInline1">
                                    Tidak
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="row sm-1">
                        <div class="sm-1">
                            <label for="exampleInputMobile" class="col-sm-8 col-form-label">
                                Tidak mendengar bila dipanggil
                            </label>
                            <div class="form-check form-check-inline">
                                <input type="radio" class="form-check-input" name="radioInline2" id="radioInline">
                                <label class="form-check-label" for="radioInline">
                                    Ya
                                </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input type="radio" class="form-check-input" name="radioInline2" id="radioInline1">
                                <label class="form-check-label" for="radioInline1">
                                    Tidak
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="row sm-1">
                        <div class="sm-1">
                            <label for="exampleInputMobile" class="col-sm-8 col-form-label">
                                Tidak dapat mendengar dengan jelas
                            </label>
                            <div class="form-check form-check-inline">
                                <input type="radio" class="form-check-input" name="radioInline3" id="radioInline">
                                <label class="form-check-label" for="radioInline">
                                    Ya
                                </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input type="radio" class="form-check-input" name="radioInline3" id="radioInline1">
                                <label class="form-check-label" for="radioInline1">
                                    Tidak
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="row sm-1">
                        <div class="sm-1">
                            <label for="exampleInputMobile" class="col-sm-8 col-form-label">
                                Keluar cairan telingan
                            </label>
                            <div class="form-check form-check-inline">
                                <input type="radio" class="form-check-input" name="radioInline4" id="radioInline">
                                <label class="form-check-label" for="radioInline">
                                    Ya
                                </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input type="radio" class="form-check-input" name="radioInline4" id="radioInline1">
                                <label class="form-check-label" for="radioInline1">
                                    Tidak
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="row sm-1">
                        <div class="sm-1">
                            <label for="exampleInputMobile" class="col-sm-8 col-form-label">
                                Telinga terasa tertutup atau tersumbat
                            </label>
                            <div class="form-check form-check-inline">
                                <input type="radio" class="form-check-input" name="radioInline5" id="radioInline">
                                <label class="form-check-label" for="radioInline">
                                    Ya
                                </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input type="radio" class="form-check-input" name="radioInline5" id="radioInline1">
                                <label class="form-check-label" for="radioInline1">
                                    Tidak
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="row sm-1">
                        <div class="sm-1">
                            <label for="exampleInputMobile" class="col-sm-8 col-form-label">
                                Nyeri telinga
                            </label>
                            <div class="form-check form-check-inline">
                                <input type="radio" class="form-check-input" name="radioInline6" id="radioInline">
                                <label class="form-check-label" for="radioInline">
                                    Ya
                                </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input type="radio" class="form-check-input" name="radioInline6" id="radioInline1">
                                <label class="form-check-label" for="radioInline1">
                                    Tidak
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="row sm-1">
                        <label for="exampleInputMobile" class="col-sm-5 col-form-label">
                            Volume saat menonton TV / mendengarkan radio
                        </label>
                        <div class="col-sm-7">
                        <div class="sm-1">
                            <div class="form-check form-check-inline">
                                <input type="radio" class="form-check-input" name="radioInline7" id="radioInline">
                                <label class="form-check-label" for="radioInline">
                                    Kecil
                                </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input type="radio" class="form-check-input" name="radioInline7" id="radioInline1">
                                <label class="form-check-label" for="radioInline1">
                                    Sedang
                                </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input type="radio" class="form-check-input" name="radioInline7" id="radioInline1">
                                <label class="form-check-label" for="radioInline2">
                                    Besar
                                </label>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <h6>HASIL :</h6>
                    <div class="btn-group btn-group-lg mb-3" role="group" aria-label="Basic example">
                        <button type="button" class="btn btn-danger"><b>
                            SERUMEN 2
                        </b></button>
                        <a class="btn btn-icon btn-danger" href="#" role="button">
                            <i data-feather="edit-2"></i>
                        </a>
                    </div>
                    <h6>REKOMENDASI :</h6>
                    <p>-</p>
                </div> 
            </div>
        </form>
    </div>
</div>
<br>
<div class="card">
    <div class="card-body">
        <h6 class="card-title">PEMERIKSAAN GIGI</h6>
        <p class="text-muted mb-3">(19/02/2022)</p>
        <form class="forms-sample">
            <div class="row">
                <div class="col-md-6">
                    <div class="container">
                        <div class="row row-cols-5">
                            <div class="col">
                                <img src="..." class="rounded wd-100 wd-sm-150 me-3" alt="...">
                                <p class="tx-11 text-muted">Foto sisi depan</p>
                            </div>
                            <div class="col">
                                <img src="..." class="rounded wd-100 wd-sm-150 me-3" alt="...">
                                <p class="tx-11 text-muted">Foto sisi kanan</p>
                            </div>
                            <div class="col">
                                <img src="..." class="rounded wd-100 wd-sm-150 me-3" alt="...">
                                <p class="tx-11 text-muted">Foto sisi kiri</p>
                            </div>
                            <div class="col">
                                <img src="..." class="rounded wd-100 wd-sm-150 me-3" alt="...">
                                <p class="tx-11 text-muted">Foto sisi depan</p>
                            </div>
                            <div class="col">
                                <img src="..." class="rounded wd-100 wd-sm-150 me-3" alt="...">
                                <p class="tx-11 text-muted">Foto sisi belakang</p>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-1">
                        <label for="exampleInputMobile" class="col-sm-5 col-form-label">Frekuensi menyikat gigi</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" id="exampleInputMobile" placeholder="Frekuensi menyikat gigi">
                        </div>
                    </div>
                    <div class="row mb-1">
                        <label for="exampleInputMobile" class="col-sm-5 col-form-label">Kunjungan ke dokter gigi</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" id="exampleInputMobile" placeholder="Kunjungan ke dokter gigi">
                        </div>
                    </div>
                    <div class="row mb-1">
                        <label for="exampleInputMobile" class="col-sm-5 col-form-label">Diagnosa Dokter</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" id="exampleInputMobile" placeholder="Diagnosa Dokter">
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <h6>HASIL :</h6>
                    <button type="button" class="btn btn-success btn-lg mb-3"><b>
                        BAIK
                    </b></button>
                    <h6>REKOMENDASI :</h6>
                    <p>
                        Segera lakukan pencabutan akar ke dokter
                    </p>
                </div>
            </div>
        </form>
    </div>
</div>
<br>
<div class="row">
    <div class= "col-md-4" ><hr></div>
    <div class= "col-md-4" ><h5><span class="badge rounded-pill bg-secondary px-7 py-2 content-center">Pemeriksaan Tahun 2021</span></h5></div>
    <div class= "col-md-4" ><hr></div>
</div>
@endsection