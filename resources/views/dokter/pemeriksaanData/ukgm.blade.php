@extends('layout.master')

@section('navbar-title')
Pemeriksaan Gigi / UKGM
@endsection
@section('content')


<div class="container-fluid">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a class="text-white" href="#">Pemeriksaan Gigi</a></li>
            <li class="breadcrumb-item text-white active" aria-current="page">UKGM</li>
        </ol>
    </nav>

    {{-- data box --}}
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h6 class="mb-1">DATA PASIEN PER WILAYAH</h6>
                <span class="h9 text-primary">Masukan wilayah yang ingin ditampilkan datanya</span>

                <form class="forms-sample mt-3">
                    <div class="row mb-3">
                        <label for="exampleInputUsername2" class="col-sm-2 col-form-label">Wilayah Kelurahan</label>
                        <div class="col-sm-5">
                        <select name="kelurahan" id="id_kelurahan" class="js-example-basic-single form-select" data-width="100%"
                                placeholder="Pilih wilayah">
                                <option selected disabled>Pilih Wilayah</option>
                                @foreach ($kelurahan as $id => $nama)
                                    <option value="{{$id}}">{{$nama}}</option>
                                @endforeach
                            </select>
                        </div>

                    </div>
                    <div class="row mb-3">
                        <label for="exampleInputEmail2" class="col-sm-2 col-form-label">Posyandu</label>
                        <div class="col-sm-5 ">
                            <select name="posyandu" id="id_posyandu" class="js-example-basic-single form-select " data-width="100%"
                                placeholder="Pilih wilayah">
                                <option selected disabled>Pilih Posyandu</option>
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

                <div class="table-responsive mt-2">
                    <table id="table-ukgm" class="table">
                        <thead>
                            <tr>
                            <th hidden>id</th>
                                <th>No</th>
                                <th>Tanggal Skrinning</th>
                                <th>Waktu Skrinning</th>
                                <th>Nama </th>
                                <th>JENIS KELAMIN</th>
                                <th>Posyandu</th>
                                <th>umur</th>
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


$(document).ready(function() {
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
        var tableData;
        var kelurahan;
        var posyandu;

            tableData = $('#table-ukgm').DataTable({
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
                    url: "{{ url('list-anak-ukgm') }}",
                    type: "GET",
                    data: function (d) {
                        d.id_posyandu = posyandu;
                        d.id_kelurahan = kelurahan;
                        return d;

                    }


                },
                columns: [{
                        data: 'id',
                        name: 'id',
                        visible: false
                    },
                    {
                        data:'DT_RowIndex',
                        name:'DT_RowIndex',
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
                        visible: true
                    },
                    {
                        data: 'jenis_kelamin',
                        name: 'jenis_kelamin',
                        visible: true
                    },

                    {
                        data: 'posyandu',
                        name:'posyandu',
                        visible: true
                    },
                    {
                        data: 'umur',
                        name:'umur',
                        visible: true
                    },

                    {
                        data: 'action',
                        name: 'action',
                        visible: true
                    },

                ],

            });

    $('#id_kelurahan').change(function() {
        var kelurahan = $(this).val();
        $("#id_posyandu").children().remove();
        $("#id_posyandu").val('');
        $("#id_posyandu").append('<option value="">---Pilih posyandu---</option>');
        $("#id_posyandu").prop('disabled', true);

        if (kelurahan != '' && kelurahan != null) {
            $.ajax({
                url: "{{ url('') }}/list-posyandu/" + kelurahan,
                success: function(res) {
                    $("#id_posyandu").prop('disabled', false);
                    var tampilan_option = '';
                    $.each(res, function(index, posyandu) {
                        tampilan_option += '<option value="' + posyandu.id + '">' + posyandu.nama +
                            '</option>';
                    });
                    $("#id_posyandu").append(tampilan_option);

                    // Load data after selecting kelurahan

                },
            });
            tableData.ajax.reload(null, false);
        }
    });

    $('#id_posyandu').change(function () {

        posyandu = $(this).val();
        tableData.ajax.reload(null, false);
    });




});



</script>


@endpush
