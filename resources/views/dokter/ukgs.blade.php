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
                        <label for="exampleInputEmail2" class="col-sm-2 col-form-label">Sekolah</label>
                        <div class="col-sm-5">
                            <select class="js-example-basic-single form-select" data-width="100%"
                                placeholder="Pilih wilayah">
                                <option selected disabled>Pilih Sekolah</option>
                                <option value="#">Option 1</option>
                                <option value="#">Option 2</option>
                                <option value="#">Option 3</option>
                                <option value="#">Option 4</option>
                                <option value="#">Option 5</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="exampleInputMobile" class="col-sm-2 col-form-label">Kelas</label>
                        <div class="col-sm-5">
                            <select class="js-example-basic-single form-select" data-width="100%"
                                placeholder="Pilih wilayah">
                                <option selected disabled>Pilih Kelas</option>
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
                    <table id="table-ukgs" class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>TANGGAL SKRINING</th>
                                <th>NAMA</th>
                                <th>JENIS KELAMIN</th>
                                <th>AKSI</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- <tr>
                                <td>1</td>
                                <td>07/02/2020</td>
                                <td>14:00</td>
                                <td>Adisty Sahida </td>
                                <td>Laki-laki</td>
                                <td>SDN Pulo 07</td>
                                <td>5</td>
                                <td><a type="button" class="btn btn-primary btn-xs text-white" data-bs-toggle="tooltip" data-bs-placement="top" title="Rekap Data"><i class="mdi mdi-book-open-page-variant"></i></a> <a type="button" class="btn btn-info btn-xs text-white" data-bs-toggle="tooltip" data-bs-placement="top" title="Periksa" href="{{route('dokter.pemeriksaanDataUKGS')}}">Periksa  <i class="mdi mdi-tooth"></i></a></td>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td>07/02/2020</td>
                                <td>14:00</td>
                                <td>Adisty Sahida </td>
                                <td>Laki-laki</td>
                                <td>SDN Pulo 07</td>
                                <td>5</td>
                                <td><a type="button" class="btn btn-primary btn-xs text-white" data-bs-toggle="tooltip" data-bs-placement="top" title="Rekap Data"><i class="mdi mdi-book-open-page-variant"></i></a> <a type="button" class="btn btn-info btn-xs text-white" data-bs-toggle="tooltip" data-bs-placement="top" title="Periksa" href="{{route('dokter.pemeriksaanDataUKGS')}}">Periksa  <i class="mdi mdi-tooth"></i></a></td>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td>07/02/2020</td>
                                <td>14:00</td>
                                <td>Adisty Sahida </td>
                                <td>Laki-laki</td>
                                <td>SDN Pulo 07</td>
                                <td>5</td>
                                <td><a type="button" class="btn btn-primary btn-xs text-white" data-bs-toggle="tooltip" data-bs-placement="top" title="Rekap Data"><i class="mdi mdi-book-open-page-variant"></i></a> <a type="button" class="btn btn-info btn-xs text-white" data-bs-toggle="tooltip" data-bs-placement="top" title="Periksa" href="{{route('dokter.pemeriksaanDataUKGS')}}">Periksa  <i class="mdi mdi-tooth"></i></a></td>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td>07/02/2020</td>
                                <td>14:00</td>
                                <td>Adisty Sahida </td>
                                <td>Laki-laki</td>
                                <td>SDN Pulo 07</td>
                                <td>5</td>
                                <td><a type="button" class="btn btn-primary btn-xs text-white" data-bs-toggle="tooltip" data-bs-placement="top" title="Rekap Data"><i class="mdi mdi-book-open-page-variant"></i></a> <a type="button" class="btn btn-info btn-xs text-white" data-bs-toggle="tooltip" data-bs-placement="top" title="Periksa" href="{{route('dokter.pemeriksaanDataUKGS')}}">Periksa  <i class="mdi mdi-tooth"></i></a></td>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td>07/02/2020</td>
                                <td>14:00</td>
                                <td>Adisty Sahida </td>
                                <td>Laki-laki</td>
                                <td>SDN Pulo 07</td>
                                <td>5</td>
                                <td><a type="button" class="btn btn-primary btn-xs text-white" data-bs-toggle="tooltip" data-bs-placement="top" title="Rekap Data"><i class="mdi mdi-book-open-page-variant"></i></a> <a type="button" class="btn btn-info btn-xs text-white" data-bs-toggle="tooltip" data-bs-placement="top" title="Periksa" href="{{route('dokter.pemeriksaanDataUKGS')}}">Periksa  <i class="mdi mdi-tooth"></i></a></td>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td>07/02/2020</td>
                                <td>14:00</td>
                                <td>Adisty Sahida </td>
                                <td>Laki-laki</td>
                                <td>SDN Pulo 07</td>
                                <td>5</td>
                                <td><a type="button" class="btn btn-primary btn-xs text-white" data-bs-toggle="tooltip" data-bs-placement="top" title="Rekap Data"><i class="mdi mdi-book-open-page-variant"></i></a> <a type="button" class="btn btn-info btn-xs text-white" data-bs-toggle="tooltip" data-bs-placement="top" title="Periksa" href="{{route('dokter.pemeriksaanDataUKGS')}}">Periksa  <i class="mdi mdi-tooth"></i></a></td>
                            </tr>    --}}
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    {{-- end of tabel data --}}
</div>

@endsection

@push('after-script')


<script type="text/javascript">

$(document).ready(function () {

    var tableData;
    function load_data(anak = '') {
            tableData = $('#table-ukgs').DataTable({
                "oLanguage": {
                    "sEmptyTable": "Silakan pilih anak terlebih dahulu",
                    "zeroRecords": "Data tidak ditemukan",
                },
                processing: true,
                serverSide: true,

                language: {
                    search: "_INPUT_",
                    searchPlaceholder: "Cari",
                    processing: `<div class="spinner-border text-primary" role="status">
                             <span class="visually-hidden">Loading...</span>
                            </div>`
                },
                "searching": true,
                "bPaginate": true,
                serverSide: true,
                stateSave: true,
                ajax: {
                    url: "{{ url('list-anakdokter') }}",
                    type: "GET",
                    data: {
                        anak: anak
                    }
                },
                columns: [{
                        data: 'id',
                        name: 'id',
                        visible: false
                    },
                    {
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        visible: true
                    },

                    {
                        data: 'tanggal',
                        name: 'tanggal',
                        visible: true
                    },
                  
                    {
                        data: 'nama',
                        name: 'nama',
                        visible: true
                    },
                    {
                        data: 'jenis_kelamin',
                        name: 'jenis_kelamin',
                        visible: true
                    },




                ],

            });
        }
        $('#id_kelas').change(function () {
            var anak = $(this).val();

            if (anak) {
                $('#table-ukgs').DataTable().clear().destroy();

                load_data(anak);
            } else {
                $('#table-ukgs').DataTable().clear().destroy();
               

            }
        });
});

</script>
@endpush
