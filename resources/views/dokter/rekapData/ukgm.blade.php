@extends('layout.master')

@section('content')


<div class="container-fluid">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Pemeriksaan Gigi</a></li>
            <li class="breadcrumb-item active" aria-current="page">UKGM</li>
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
                        <select name="kelurahan" id="id_desa" class="js-example-basic-single form-select" data-width="100%"
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
                            <select name="sekolah" id="id_posyandu" class="js-example-basic-single form-select " data-width="100%"
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
</div>


@endsection

@push('after-script')

<script type="text/javascript">


$(document).ready(function() {

    if ($('#id_kelas').val() == 'null') {
            $('#table-ukgs').DataTable({
                "oLanguage": {
                    "sEmptyTable": "Silahkan pilih sekolah dan kelas terlebih dahulu",
                },
            }).clear();

        } else {
            $('#table-ukgs').DataTable({
                "oLanguage": {
                    "sEmptyTable": "Silahkan pilih sekolah dan kelas terlebih dahulu",
                },
            }).clear();


        }
        $(".ket-data").hide()


        $('#id_desa').change(function () {
            let desa = $("#id_desa").val()
            $("#id_posyandu").children().remove();
            $("#id_posyandu").val('');
            $("#id_posyandu").append('<option value="">---Pilih posyandu---</option>');
            $("#id_posyandu").prop('disabled', true)
            if (desa!= '' && desa!= null) {
                $.ajax({
                    url: "{{url('')}}/list-posyandu/" + desa,
                    success: function (res) {
                        $("#id_posyandu").prop('disabled', false)
                        let tampilan_option = '';
                        $.each(res, function (index, posyandu) {
                            tampilan_option +=
                                `<option value="${posyandu.id}">${posyandu.nama}</option>`
                        })
                        $("#id_posyandu").append(tampilan_option);
                    },
                });
            }
        });

        var tableData;
            function load_data(id_sekolah = '') {
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
                    data: {
                        id_sekolah: id_sekolah,
                        
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
        }
        $('#id_posyandu').change(function () {
            var id_sekolah= $(this).val();
           

            if (id_sekolah) {
                $('#table-ukgm').DataTable().clear().destroy();
                

                load_data(id_sekolah);
            } else {
                $('#table-ukgm').DataTable().clear().destroy();


            }
        });


            

        
        

    
});



</script>


@endpush