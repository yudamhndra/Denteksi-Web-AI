@extends('layout.master')

@section('title')
    UKGS
@endsection
@section('navbar-title')
    Pemeriksaan Gigi / UKGS
@endsection

@section('content')

    <div class="container-fluid">


        {{-- data box --}}
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="mb-1">DATA PASIEN PER WILAYAH</h6>
                    <span class="h9 text-primary">Masukan wilayah yang ingin ditampilkan datanya</span>

                    <form class="forms-sample mt-3">


                        <div class="row mb-3">
                            <label for="exampleInputUsername2" class="col-sm-2 col-form-label">Wilayah Kelurahan</label>
                            <div class="col-sm-5 ">
                                <select name="kelurahan" id="id_desa" class="js-example-basic-single form-select"
                                        data-width="100%"
                                        placeholder="Pilih wilayah">
                                    <option selected disabled>Pilih Wilayah</option>
                                    @foreach ($kelurahan as $id => $nama)
                                        <option value="{{$id}}">{{$nama}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="exampleInputEmail2" class="col-sm-2 col-form-label">Sekolah</label>
                            <div class="col-sm-5 ">
                                <select name="sekolah" id="id_sekolah" class="js-example-basic-single form-select "
                                        data-width="100%"
                                        placeholder="Pilih wilayah">
                                    <option value="0" selected disabled>Pilih Sekolah</option>
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="exampleInputMobile" class="col-sm-2 col-form-label">Kelas</label>
                            <div class="col-sm-5">
                                <select name="kelas" id="id_kelas" class="js-example-basic-single form-select"
                                        data-width="100%"
                                        placeholder="Pilih Kelas">
                                    <option value="0" selected disabled>Pilih Kelas</option>
                                </select>
                            </div>
                        </div>
                        {{ csrf_field() }}
                    </form>

                </div>
            </div>
        </div>
        {{-- end of data box --}}

        {{-- tabel data --}}
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="h9 text-center ket-data">Berikut merupakan tabel pasien gigi di kelurahan <span
                            id="text-wilayah"></span></div>
                    <div class="table-responsive mt-2">
                        <table id="table-ukgs" class="table" style="width:100%">
                            <thead>
                            <tr>

                                <th hidden>id</th>
                                <th>No</th>
                                <th>Tanggal Skrinning</th>
                                <th>Waktu Skrinning</th>
                                <th>Nama</th>
                                <th>JENIS KELAMIN</th>
                                <th>Kelas</th>
                                <th>Sekolah</th>
                                <th>Action</th>

                            </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        {{-- end of tabel data --}}
        <div id="spinner" class="spinner-overlay hide">
            <div class="spinner">
                <div class="spinner-inner"></div>
            </div>
        </div>
    </div>
@endsection

@push('after-script')

    <script type="text/javascript">


        $(document).ready(function () {
            function showSpinner() {
                $('#spinner').removeClass('hide');
            }

            function hideSpinner() {
                $('#spinner').addClass('hide');
            }

            $(document).on('click', '.recheck-button', function() {
                var pemeriksaanId = $(this).data('pemeriksaan-id');
                showSpinner();
                recheckAPI(pemeriksaanId);
            });

            function recheckAPI(pemeriksaanId) {

                $.ajax({
                    url: '/recheck/' + pemeriksaanId,
                    type: 'GET',
                    timeout : 20000,
                    success: function(response) {
                        hideSpinner()
                        // Lakukan sesuatu dengan respons sukses
                        Swal.fire({
                            icon: 'success',
                            title: 'Data berhasil direcheck',
                            showConfirmButton: false,
                            timer: 1500
                        });
                    },
                    error: function(error) {
                        hideSpinner()
                        // Lakukan sesuatu dengan respons gagal
                        console.error(error);
                        // Tampilkan pesan gagal ke pengguna
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal dalam melakukan recheck',
                            showConfirmButton: false,
                            timer: 1500
                        });
                    }
                });
            }


            $(".ket-data").hide()
            $('#id_desa').change(function () {

                let kelurahan = $("#id_desa").val()
                let namadesa = $('#id_desa option:selected').text()

                $("#id_sekolah").children().remove();
                $("#id_sekolah").val('');
                $("#id_sekolah").append('<option value="">---Pilih Sekolah---</option>');
                $("#id_sekolah").prop('disabled', true)
                $("#id_kelas").children().remove();
                $("#id_kelas").val('');
                $("#id_kelas").append('<option disable value="0">---Pilih Kelas---</option>');
                $("#id_kelas").prop('disabled', true)
                $("#text-wilayah").empty()
                $("#text-wilayah").append(namadesa)
                $(".ket-data").show()

                if (kelurahan != '' && kelurahan != null) {
                    $.ajax({
                        url: "{{url('')}}/list-sekolah/" + kelurahan,
                        success: function (res) {
                            $("#id_sekolah").prop('disabled', false)
                            let tampilan_option = '';
                            $.each(res, function (index, sekolah) {
                                tampilan_option +=
                                    `<option value="${sekolah.id}">${sekolah.nama}</option>`
                            })
                            $("#id_sekolah").append(tampilan_option);
                        },
                    });
                }
            });

            $('#id_sekolah').change(function () {

                sekolah = $("#id_sekolah").val()

                $("#id_kelas").children().remove();
                $("#id_kelas").val('');
                $("#id_kelas").append('<option value="">---Pilih Kelas---</option>');
                $("#id_kelas").prop('disabled', true)

                if (sekolah != '' && sekolah != null) {
                    $.ajax({
                        url: "{{url('')}}/list-kelas/" + sekolah,
                        success: function (res) {
                            $("#id_kelas").prop('disabled', false)
                            let tampilan_option = '';
                            $.each(res, function (index, kelas) {
                                tampilan_option +=
                                    `<option value="${kelas.id}">${kelas.kelas}</option>`
                            })
                            $("#id_kelas").append(tampilan_option);
                        },
                    });
                    tableData.ajax.reload(null, false);
                }

            });

            var tableData;
            var id_kelas;
            var sekolah;
            var kelurahan;

            tableData = $('#table-ukgs').DataTable({

                "oLanguage": {
                    "sEmptyTable": "Silahkan pilih sekolah dan kelas terlebih dahulu",
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
                    data: function (d) {
                        d.id_sekolah = sekolah;
                        d.id_kelas = id_kelas;
                        d.kelurahan = kelurahan;
                        return d;

                    }

                },
                columns: [{
                    data: 'id',
                    name: 'id',
                    visible: false,

                },
                    {
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        visible: true,
                        orderable: false, searchable: false
                    },

                    {
                        data: 'tanggal',
                        name: 'tanggal',
                        visible: true

                    },
                    {
                        data: 'waktu',
                        name: 'waktu',
                        visible: true
                    },
                    {
                        data: 'nama',
                        name: 'nama',
                        visible: true,
                        searchable: true
                    },
                    {
                        data: 'jenis_kelamin',
                        name: 'jenis_kelamin',
                        visible: true
                    },
                    {
                        data: 'kelas',
                        name: 'kelas',
                        visible: true
                    },
                    {
                        data: 'sekolah',
                        name: 'sekolah',
                        visible: true
                    },
                    {
                        data: 'action',
                        name: 'action',
                        visible: true
                    },


                ],

            });


            $('#id_kelas').change(function () {

                id_kelas = $(this).val();
                tableData.ajax.reload(null, false);
            });



        });


    </script>

@endpush
