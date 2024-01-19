@extends('layout.master')

@section('content')


<div class="container-fluid">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Pemeriksaan Gigi</a></li>
            <li class="breadcrumb-item active" aria-current="page">UKGS</li>
        </ol>
    </nav>

    {{-- data box --}}
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h6 class="mb-1">DATA PASIEN PER WILAYAH</h6>
                <span class="h9 text-facebook">Masukan wilayah yang ingin ditampilkan datanya</span>

                <form class="forms-sample mt-3">
                    <div class="row mb-3">
                        <label for="exampleInputUsername2" class="col-sm-2 col-form-label">Wilayah Kelurahan</label>
                        <div class="col-sm-5">
                            <select class="js-example-basic-single form-select" data-width="100%"
                                placeholder="Pilih wilayah">
                                <option selected disabled>Pilih Wilayah</option>
                                <option value="#">Option 1</option>
                                <option value="#">Option 2</option>
                                <option value="#">Option 3</option>
                                <option value="#">Option 4</option>
                                <option value="#">Option 5</option>
                            </select>
                        </div>

                    </div>
                    <div class="row mb-3">
                        <label for="exampleInputEmail2" class="col-sm-2 col-form-label">Posyandu</label>
                        <div class="col-sm-5">
                            <select class="js-example-basic-single form-select" data-width="100%"
                                placeholder="Pilih Posyandu">
                                <option selected disabled>Pilih Posyandu</option>
                                <option value="#">Option 1</option>
                                <option value="#">Option 2</option>
                                <option value="#">Option 3</option>
                                <option value="#">Option 4</option>
                                <option value="#">Option 5</option>
                            </select>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- end of data box --}}

    {{-- tabel data --}}
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <span class="h9 text-facebook">Berikut merupakan tabel pasien gigi di Pulo</span>
                <div class="table-responsive mt-2">
                    <table id="dataTableExample" class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>TANGGAL SKRINING</th>
                                <th>WAKTU</th>
                                <th>NAMA</th>
                                <th>JENIS KELAMIN</th>
                                <th>NAMA Posyandu</th>
                                <th>USIA</th>
                                <th>AKSI</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>07/02/2020</td>
                                <td>14:00</td>
                                <td>Omar </td>
                                <td>Laki-laki</td>
                                <td>Seruni</td>
                                <td>2 tahun 1 Bulan</td>
                                <td><a type="button" class="btn btn-primary btn-xs text-white" data-bs-toggle="tooltip" data-bs-placement="top" title="Rekap Data"><i class="mdi mdi-book-open-page-variant"></i></a> <a type="button" class="btn btn-info btn-xs text-white" data-bs-toggle="tooltip" data-bs-placement="top" title="Periksa" href="{{route('dokter.pemeriksaanDataUKGM')}}">Periksa  <i class="mdi mdi-tooth"></i></a></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    {{-- end of tabel data --}}
</div>


@endsection
