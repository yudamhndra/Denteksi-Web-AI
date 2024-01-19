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
                    <tr style="color: white; line-height: 14px;">
                        <td><h3><b>{{ $pemeriksaanFisik->anak->nama}}</b></h3></td>
                    </tr>
                    <tr style="color: white; line-height: 5px; font-size:small">
                        <td>Nama</td>
                        <td>Jenis Kelamin</td>
                        @if($pemeriksaanFisik->id_kelas !=null &&$pemeriksaanFisik->id_sekolah==null)
                        <td>Sekolahh</td>
                        <td>Kelas</td>
                        @else
                        <td>Posyandu</td>
                        @endif
                        <td>TTL</td>
                        <td>Usia Anak</td>
                    </tr>
                    <tr style="color: white; line-height: 10px; font-size:larger;">
                        <td>{{ $pemeriksaanFisik->anak->nama }}</td>
                        <td>{{ $pemeriksaanFisik->anak->jenis_kelamin }}</td>
                        @if($pemeriksaanFisik->id_kelas !=null &&$pemeriksaanFisik->id_sekolah==null)
                        <td>{{ $pemeriksaanFisik->kelas->sekolah->nama}}</td>
                        <td>{{ $pemeriksaanFisik->kelas->kelas }}</td>
                        @else
                        <td>{{ $pemeriksaanFisik->sekolah->nama}}</td>
                        @endif
                        <?php
                            $now = new DateTime(date('Y-m-d'));
                            $ttl = new DateTime(($pemeriksaanFisik->anak->tanggal_lahir));
                            $lahir = $ttl->format('d/m/Y');
                            $different = $now->diff($ttl);
                            $year = $different->format('%y Tahun %m Bulan');
                        ?>
                        <td>{{ $pemeriksaanFisik->anak->tempat_lahir }}, {{ $lahir }}</td>

                        <td>{{ $year }} </td>
                    </tr>
                </table>
            </div>
            <div class="col-md-auto">
                <i data-feather="arrow-right-circle"></i>
            </div>
        </div>
    </div>
</div>
<br>


@if(empty($pemeriksaanFisik))
<div class="row align-center text-center">
    <div class= "col-md-4" ><hr></div>
    <div class= "col-md-4" ><h5><span class="badge rounded-pill bg-secondary px-6 py-2 content-center">Data Pemeriksaan Kosong</span></h5></div>
    <div class= "col-md-4" ><hr></div>
</div>
@else
<div class="row">
    <div class= "col-md-4" ><hr></div>
    <div class= "col-md-4" ><h5><span class="badge rounded-pill bg-secondary px-6 py-2 content-center">Pemeriksaan Tahun (Tahun 2022)</span></h5></div>
    <div class= "col-md-4" ><hr></div>
</div>
<br>
<div class="card">
    <div class="card-body">
        <h6 class="card-title">PEMERIKSAAN FISIK</h6>
                          <?php

                            $date = new DateTime(($pemeriksaanFisik->waktu_pemeriksaan));

                            $waktu_pemeriksaan = $date->format('d/m/y');
                            ?>
        <p class="text-muted mb-3">({{$waktu_pemeriksaan}})</p>
        <form class="forms-sample">
            <div class="row">
                <div class="col-md-9">
                    <div class="row mb-3">
                        <label for="exampleInputMobile" class="col-sm-3 col-form-label">Tinggi badan (cm)</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="exampleInputMobile" placeholder="Tinggi badan" readonly value="{{ $pemeriksaanFisik->tinggi_badan }}">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="exampleInputMobile" class="col-sm-3 col-form-label">Berat badan (kg)</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="exampleInputMobile" placeholder="Berat badan" readonly value="{{ $pemeriksaanFisik->berat_badan }}">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="exampleInputMobile" class="col-sm-3 col-form-label">IMT (kg/m2)</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="exampleInputMobile" placeholder="IMT" readonly value="{{ $pemeriksaanFisik->imt }}">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="exampleInputMobile" class="col-sm-3 col-form-label">Sistole (mmHg)</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="exampleInputMobile" placeholder="Sistole" readonly value="{{ $pemeriksaanFisik->sistole }}">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="exampleInputMobile" class="col-sm-3 col-form-label">Diastole (mmHg)</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="exampleInputMobile" placeholder="Diastole" readonly value="{{ $pemeriksaanFisik->diastole }}">
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
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
        <p class="text-muted mb-3">({{$waktu_pemeriksaan}})</p>
        <form class="forms-sample">
            <div class="row">
                <div class="col-md-9">
                    <div class="row sm-1">
                        <div class="sm-1">
                            <label for="exampleInputMobile" class="col-sm-6 col-form-label">
                                Mata perih/merah dan bengkak
                            </label>
                            <div class="form-check form-check-inline">
                                <input type="radio" class="form-check-input" name="radioInline" id="radioInline" {{ ($pemeriksaanMata->msoal1 == "ya") ? 'checked' : '' }}>
                                <label class="form-check-label" for="radioInline">
                                    Ya
                                </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input type="radio" class="form-check-input" name="radioInline" id="radioInline1" {{ ($pemeriksaanMata->msoal1 != "ya") ? 'checked' : '' }}>
                                <label class="form-check-label" for="radioInline1">
                                    Tidak
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="row sm-1">
                        <div class="sm-1">
                            <label for="exampleInputMobile" class="col-sm-6 col-form-label">
                                Tidak dapat membaca/melihat dengan jelas
                            </label>
                            <div class="form-check form-check-inline">
                                <input type="radio" class="form-check-input" name="radioInline2" id="radioInline"  {{ ($pemeriksaanMata->msoal2 == "ya") ? 'checked' : '' }}>
                                <label class="form-check-label" for="radioInline">
                                    Ya
                                </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input type="radio" class="form-check-input" name="radioInline2" id="radioInline1"  {{ ($pemeriksaanMata->msoal2 != "ya") ? 'checked' : '' }}>
                                <label class="form-check-label" for="radioInline1">
                                    Tidak
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="row sm-1">
                        <div class="sm-1">
                            <label for="exampleInputMobile" class="col-sm-6 col-form-label">
                                Menggunakan kacamata
                            </label>
                            <div class="form-check form-check-inline">
                                <input type="radio" class="form-check-input" name="radioInline3" id="radioInline"  {{ ($pemeriksaanMata->msoal3 == "ya") ? 'checked' : '' }}>
                                <label class="form-check-label" for="radioInline">
                                    Ya
                                </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input type="radio" class="form-check-input" name="radioInline3" id="radioInline1"  {{ ($pemeriksaanMata->msoal3 != "ya") ? 'checked' : '' }}>
                                <label class="form-check-label" for="radioInline1">
                                    Tidak
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="row sm-1">
                        <div class="sm-1">
                            <label for="exampleInputMobile" class="col-sm-6 col-form-label">
                                Mata juling
                            </label>
                            <div class="form-check form-check-inline">
                                <input type="radio" class="form-check-input" name="radioInline4" id="radioInline"  {{ ($pemeriksaanMata->msoal4 == "ya") ? 'checked' : '' }}>
                                <label class="form-check-label" for="radioInline">
                                    Ya
                                </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input type="radio" class="form-check-input" name="radioInline4" id="radioInline1"  {{ ($pemeriksaanMata->msoal4 != "ya") ? 'checked' : '' }}>
                                <label class="form-check-label" for="radioInline1">
                                    Tidak
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="row sm-1">
                        <div class="sm-1">
                            <label for="exampleInputMobile" class="col-sm-6 col-form-label">
                                Tidak dapat membedakan warna dengan baik
                            </label>
                            <div class="form-check form-check-inline">
                                <input type="radio" class="form-check-input" name="radioInline5" id="radioInline"  {{ ($pemeriksaanMata->msoal5 == "ya") ? 'checked' : '' }}>
                                <label class="form-check-label" for="radioInline">
                                    Ya
                                </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input type="radio" class="form-check-input" name="radioInline5" id="radioInline1"  {{ ($pemeriksaanMata->msoal5 != "ya") ? 'checked' : '' }}>
                                <label class="form-check-label" for="radioInline1">
                                    Tidak
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="row sm-1">
                        <div class="sm-1">
                            <label for="exampleInputMobile" class="col-sm-6 col-form-label">
                            Bagaimana kondisi kesehatan mata anak
                            </label>
                            <div class="form-check form-check-inline">
                                <input type="radio" class="form-check-input" name="radioInline5" id="radioInline"  {{ ($pemeriksaanMata->msoal6 == "normal") ? 'checked' : '' }}>
                                <label class="form-check-label" for="radioInline">
                                    Normal
                                </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input type="radio" class="form-check-input" name="radioInline5" id="radioInline1"  {{ ($pemeriksaanMata->msoal6 == "minus") ? 'checked' : '' }}>
                                <label class="form-check-label" for="radioInline1">
                                    Minus
                                </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input type="radio" class="form-check-input" name="radioInline5" id="radioInline1"  {{ ($pemeriksaanMata->msoal6 == "butawarna") ? 'checked' : '' }}>
                                <label class="form-check-label" for="radioInline1">
                                    Buta Warna
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <h6>HASIL :</h6>
                    <div class="btn-group btn-group-lg mb-3" role="group" aria-label="Basic example">
                        @if($pemeriksaanMata->msoal6=="normal")
                        <button type="button" class="btn btn-success"><b>
                        Normal
                        </b></button>
                        <a class="btn btn-icon btn-success" href="#" role="button">
                            <i data-feather="edit-2"></i>
                        </a>
                        @elseif($pemeriksaanMata->msoal6=="minus")
                        <button type="button" class="btn btn-danger"><b>
                        Minus
                        </b></button>
                        <a class="btn btn-icon btn-danger" href="#" role="button">
                            <i data-feather="edit-2"></i>
                        </a>
                        @else
                        <button type="button" class="btn btn-warning"><b>
                        Butawarna
                        </b></button>
                        <a class="btn btn-icon btn-warning" href="#" role="button">
                            <i data-feather="edit-2"></i>
                        </a>
                        @endif

                    </div>
                    <h6>REKOMENDASI :</h6>
                    <p>-</p>
                </div>
            </div>
        </form>
    </div>
</div>
<br>
<!-- {{ $pemeriksaanTelinga }} -->
<div class="card">
    <div class="card-body">
        <h6 class="card-title">PEMERIKSAAN TELINGA</h6>
        <p class="text-muted mb-3">({{$waktu_pemeriksaan}})</p>
        <form class="forms-sample">
            <div class="row">
                <div class="col-md-9">
                    <div class="row sm-1">
                        <div class="sm-1">
                            <label for="exampleInputMobile" class="col-sm-6 col-form-label">
                                Tidak merespon bila ada suara keras
                            </label>
                            <div class="form-check form-check-inline">
                                <input type="radio" class="form-check-input" name="radioInline" id="radioInline"  {{ ($pemeriksaanTelinga->tsoal1 == "ya") ? 'checked' : '' }}>
                                <label class="form-check-label" for="radioInline">
                                    Ya
                                </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input type="radio" class="form-check-input" name="radioInline" id="radioInline1"  {{ ($pemeriksaanTelinga->tsoal1 != "ya") ? 'checked' : '' }}>
                                <label class="form-check-label" for="radioInline1">
                                    Tidak
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="row sm-1">
                        <div class="sm-1">
                            <label for="exampleInputMobile" class="col-sm-6 col-form-label">
                                Tidak mendengar bila dipanggil
                            </label>
                            <div class="form-check form-check-inline">
                                <input type="radio" class="form-check-input" name="radioInline2" id="radioInline" {{ ($pemeriksaanTelinga->tsoal2 == "ya") ? 'checked' : '' }}>
                                <label class="form-check-label" for="radioInline">
                                    Ya
                                </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input type="radio" class="form-check-input" name="radioInline2" id="radioInline1" {{ ($pemeriksaanTelinga->tsoal2 != "ya") ? 'checked' : '' }}>
                                <label class="form-check-label" for="radioInline1">
                                    Tidak
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="row sm-1">
                        <div class="sm-1">
                            <label for="exampleInputMobile" class="col-sm-6 col-form-label">
                                Tidak dapat mendengar dengan jelas
                            </label>
                            <div class="form-check form-check-inline">
                                <input type="radio" class="form-check-input" name="radioInline3" id="radioInline" {{ ($pemeriksaanTelinga->tsoal3 == "ya") ? 'checked' : '' }}>
                                <label class="form-check-label" for="radioInline">
                                    Ya
                                </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input type="radio" class="form-check-input" name="radioInline3" id="radioInline1" {{ ($pemeriksaanTelinga->tsoal3 != "ya") ? 'checked' : '' }}>
                                <label class="form-check-label" for="radioInline1">
                                    Tidak
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="row sm-1">
                        <div class="sm-1">
                            <label for="exampleInputMobile" class="col-sm-6 col-form-label">
                                Keluar cairan telingan
                            </label>
                            <div class="form-check form-check-inline">
                                <input type="radio" class="form-check-input" name="radioInline4" id="radioInline" {{ ($pemeriksaanTelinga->tsoal4 == "ya") ? 'checked' : '' }}>
                                <label class="form-check-label" for="radioInline">
                                    Ya
                                </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input type="radio" class="form-check-input" name="radioInline4" id="radioInline1" {{ ($pemeriksaanTelinga->tsoal4 != "ya") ? 'checked' : '' }}>
                                <label class="form-check-label" for="radioInline1">
                                    Tidak
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="row sm-1">
                        <div class="sm-1">
                            <label for="exampleInputMobile" class="col-sm-6 col-form-label">
                                Telinga terasa tertutup atau tersumbat
                            </label>
                            <div class="form-check form-check-inline">
                                <input type="radio" class="form-check-input" name="radioInline5" id="radioInline" {{ ($pemeriksaanTelinga->tsoal5 == "ya") ? 'checked' : '' }}>
                                <label class="form-check-label" for="radioInline">
                                    Ya
                                </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input type="radio" class="form-check-input" name="radioInline5" id="radioInline1" {{ ($pemeriksaanTelinga->tsoal5 != "ya") ? 'checked' : '' }}>
                                <label class="form-check-label" for="radioInline1">
                                    Tidak
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="row sm-1">
                        <div class="sm-1">
                            <label for="exampleInputMobile" class="col-sm-6 col-form-label">
                                Nyeri telinga
                            </label>
                            <div class="form-check form-check-inline">
                                <input type="radio" class="form-check-input" name="radioInline6" id="radioInline"{{ ($pemeriksaanTelinga->tsoal6 == "ya") ? 'checked' : '' }}>
                                <label class="form-check-label" for="radioInline">
                                    Ya
                                </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input type="radio" class="form-check-input" name="radioInline6" id="radioInline1" {{ ($pemeriksaanTelinga->tsoal6 != "ya") ? 'checked' : '' }}>
                                <label class="form-check-label" for="radioInline1">
                                    Tidak
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="row sm-1">
                        <div class="sm-1">
                            <label for="exampleInputMobile" class="col-sm-6 col-form-label">
                            Terdapat serumen pada bagian telinga kanan anak
                            </label>
                            <div class="form-check form-check-inline">
                                <input type="radio" class="form-check-input" name="radioInline7" id="radioInline" {{ ($pemeriksaanTelinga->tsoal7 == "ya") ? 'checked' : '' }}>
                                <label class="form-check-label" for="radioInline">
                                    Ya
                                </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input type="radio" class="form-check-input" name="radioInline7" id="radioInline1" {{ ($pemeriksaanTelinga->tsoal7 != "ya") ? 'checked' : '' }}>
                                <label class="form-check-label" for="radioInline1">
                                    Tidak
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="row sm-1">
                        <div class="sm-1">
                            <label for="exampleInputMobile" class="col-sm-6 col-form-label">
                            Terdapat serumen pada bagian telinga kiri anak
                            </label>
                            <div class="form-check form-check-inline">
                                <input type="radio" class="form-check-input" name="radioInline8" id="radioInline" {{ ($pemeriksaanTelinga->tsoal8 == "ya") ? 'checked' : '' }}>
                                <label class="form-check-label" for="radioInline">
                                    Ya
                                </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input type="radio" class="form-check-input" name="radioInline8" id="radioInline1" {{ ($pemeriksaanTelinga->tsoal8 != "ya") ? 'checked' : '' }}>
                                <label class="form-check-label" for="radioInline1">
                                    Tidak
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="row sm-1">
                        <div class="sm-1">
                            <label for="exampleInputMobile" class="col-sm-6 col-form-label">
                            Volume saat menonton TV / mendengarkan radio
                            </label>
                            <div class="form-check form-check-inline">
                            <input type="radio" class="form-check-input" name="radioInline9" id="radioInline" {{ ($pemeriksaanTelinga->tsoal9=="kecil") ? 'checked' : '' }}>
                                <label class="form-check-label" for="radioInline">
                                    Kecil
                                </label>
                            </div>
                            <div class="form-check form-check-inline">
                            <input type="radio" class="form-check-input" name="radioInline9" id="radioInline1" {{ ($pemeriksaanTelinga->tsoal9 =="sedang") ? 'checked' : '' }}>
                                <label class="form-check-label" for="radioInline1">
                                   Sedang
                                </label>
                            </div>
                            <div class="form-check form-check-inline">
                            <input type="radio" class="form-check-input" name="radioInline9" id="radioInline1" {{ ($pemeriksaanTelinga->tsoal9=="besar") ? 'checked' : '' }}>
                                <label class="form-check-label" for="radioInline1">
                                   Keras
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <h6>HASIL :</h6>
                    <div class="btn-group btn-group-lg mb-3" role="group" aria-label="Basic example">
                        <button type="button" class="btn btn-danger"><b>
                            <?php
                        if($pemeriksaanTelinga->tsoal7=='ya'&& $pemeriksaanTelinga->tsoal8=='ya'){
                    $data = 'Serumen 2';
                }else if($pemeriksaanTelinga->tsoal7=='ya'&& $pemeriksaanTelinga->tsoal8=='tidak'){
                    $data = 'Serumen Kanan';
                }else if($pemeriksaanTelinga->tsoal7=='tidak'&& $pemeriksaanTelinga->tsoal8=='ya'){
                    $data = 'Serumen Kiri';
                }else{
                    $data = 'Serumen Tidak Ada';
                }
                ?>
                    {{$data}}
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
@if(empty($pemeriksaanGigi))
<div class="row align-center text-center">
    <div class= "col-md-4" ><hr></div>
    <div class= "col-md-4" ><h5><span class="badge rounded-pill bg-secondary px-6 py-2 content-center">Data Pemeriksaan Gigi Kosong</span></h5></div>
    <div class= "col-md-4" ><hr></div>
</div>
@else
<div class="card">
    <div class="card-body">
        <h6 class="card-title">PEMERIKSAAN GIGI</h6>
                         <?php
                            $gigi = new DateTime(($pemeriksaanGigi->waktu_pemeriksaan));

                            $waktu_periksa= $date->format('d/m/y');
                            ?>
        <p class="text-muted mb-3">({{$waktu_periksa}})</p>
        <form class="forms-sample">
            <div class="row">
                <div class="col-md-9">
                    <div class="container">
                        <div class="row row-cols-5">
                            <div class="col">
                                <img style="width:75px; height:75px;object-fit: cover; object-position: bottom;" src="{{url ('storage/gigi/'.$pemeriksaanGigi->gambar1) ?? ''}}" class=" img-fluid " alt="...">
                                <p class="tx-11 text-muted">Foto sisi depan</p>
                            </div>
                            <div class="col">
                                <img style="width:75px; height:75px;object-fit: cover; object-position: bottom;" src="{{url ('storage/gigi/'.$pemeriksaanGigi->gambar2) ?? ''}}" class="img-fluid" alt="..." >
                                <p class="tx-11 text-muted">Foto sisi kanan</p>
                            </div>
                            <div class="col">
                                <img  style="width:75px; height:75px ; object-fit: cover; object-position: bottom;" src="{{url ('storage/gigi/'.$pemeriksaanGigi->gambar3) ?? ''}}" class="img-fluid" alt="...">
                                <p class="tx-11 text-muted">Foto sisi kiri</p>
                            </div>
                            <div class="col">
                                @if(!empty($pemeriksaanGigi->gambar4))
                                <img style="width:75px; height:75px ; object-fit: cover; object-position: bottom;" src="{{url ('storage/gigi/'.$pemeriksaanGigi->gambar4)}}" class="rounded wd-100 wd-sm-150 me-3" alt="..." >
                                @else
                                    <img style="width:75px; height:75px ; object-fit: cover; object-position: bottom;" src='{{@asset("assets/images/others/placeholder.jpg")}}' class="rounded wd-100 wd-sm-150 me-3" alt="..." >
                                @endif
                                <p class="tx-11 text-muted">Foto sisi depan</p>
                            </div>
                            <div class="col">
                            @if(!empty($pemeriksaanGigi->gambar5))
                                <img style="width:75px; height:75px ; object-fit: cover; object-position: bottom;" src="{{url ('storage/gigi/'.$pemeriksaanGigi->gambar5) ?? ''}}" class="img-fluid" alt="...">
                            @else
                            <img style="width:75px; height:75px ; object-fit: cover; object-position: bottom;" src='{{@asset("assets/images/others/placeholder.jpg")}}' class="rounded wd-100 wd-sm-150 me-3" alt="..." >
                            @endif
                            <p class="tx-11 text-muted">Foto sisi belakang</p>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-1">
                        <label for="exampleInputMobile" class="col-sm-5 col-form-label">Frekuensi menyikat gigi</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" id="exampleInputMobile" placeholder="Frekuensi menyikat gigi" readonly value="{{ $pemeriksaanGigi->gsoal1 }}">
                        </div>
                    </div>
                    <div class="row mb-1">
                        <label for="exampleInputMobile" class="col-sm-5 col-form-label">Kunjungan ke dokter gigi</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" id="exampleInputMobile" placeholder="Kunjungan ke dokter gigi" readonly value="{{ $pemeriksaanGigi->gsoal2 }}">
                        </div>
                    </div>
                    <div class="row mb-1">
                        <label for="exampleInputMobile" class="col-sm-5 col-form-label">Diagnosa Dokter</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" id="exampleInputMobile" placeholder="Diagnosa Dokter" readonly value="{{!empty($pemeriksaanGigi->skriningIndeks->diagnosa)?$pemeriksaanGigi->skriningIndeks->diagnosa: ''}}">
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <h6>HASIL :</h6>
                    <button type="button" class="btn btn-success btn-lg mb-3"><b>
                    {{!empty($pemeriksaanGigi->skriningIndeks->diagnosa)?$pemeriksaanGigi->skriningIndeks->diagnosa: ''}}
                    </b></button>
                    <h6>REKOMENDASI :</h6>
                    <p>
                    {{!empty($pemeriksaanGigi->skriningIndeks->rekomendasi)?$pemeriksaanGigi->skriningIndeks->rekomendasi: '-'}}
                    </p>
                </div>
            </div>
        </form>
    </div>
</div>
<br>
@endif
<div class="row align-center text-center">
    <div class= "col-md-4" ><hr></div>
    <div class= "col-md-4" ><h5><span class="badge rounded-pill bg-secondary px-7 py-2 content-center">Pemeriksaan Tahun 2021</span></h5></div>
    <div class= "col-md-4" ><hr></div>
</div>
@endif
@endsection
