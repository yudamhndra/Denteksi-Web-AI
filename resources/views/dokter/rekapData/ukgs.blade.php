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
                
                
                <form class="forms-sample mt-3">
                
                    
                    <div class="row mb-3">
                        <label for="exampleInputUsername2" class="col-sm-2 col-form-label">Wilayah Kelurahan</label>
                        <div class="col-sm-5 ">
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
                        <label for="exampleInputEmail2" class="col-sm-2 col-form-label">Sekolah</label>
                        <div class="col-sm-5 ">
                            <select name="sekolah" id="id_sekolah" class="js-example-basic-single form-select " data-width="100%"
                                placeholder="Pilih wilayah">
                                <option selected disabled>Pilih Sekolah</option>
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="exampleInputMobile" class="col-sm-2 col-form-label">Kelas</label>
                        <div class="col-sm-5">
                            <select name="kelas" id="id_kelas" class="js-example-basic-single form-select" data-width="100%"
                                placeholder="Pilih Kelas">
                                <option selected disabled>Pilih Kelas</option>
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
                <span  class="h9 text-facebook ket-data">Berikut merupakan tabel pasien gigi di <span id="text-wilayah"></span>  </span>
                <div class="table-responsive mt-2">
                    <table id="table-ukgs" class="table" style="width:100%">
                        <thead>
                            <tr>
                             
                                <th hidden>id</th>
                                <th>No</th>
                                <th>Tanggal Skrinning</th>
                                <th>Waktu Skrinning</th>
                                <th>Nama </th>
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
            let kelurahan = $("#id_desa").val()
            let namadesa = $('#id_desa option:selected').text()
            
            $("#id_sekolah").children().remove();
            $("#id_sekolah").val('');
            $("#id_sekolah").append('<option value="">---Pilih Sekolah---</option>');
            $("#id_sekolah").prop('disabled', true)
            $("#id_kelas").children().remove();
            $("#id_kelas").val('');
            $("#id_kelas").append('<option disable value="">---Pilih Kelas---</option>');
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
            let sekolah = $("#id_sekolah").val()
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
            }
        });

            var tableData;
            function load_data(id_kelas = '') {
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
                    data: {
                        id_kelas: id_kelas,
                        
                    }

                },
                columns: [{
                        data: 'id',
                        name: 'id',
                        visible: false,
                       
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
                        name:'kelas',
                        visible: true
                    },
                    {
                        data: 'sekolah',
                        name:'sekolah',
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
        $('#id_kelas').change(function () {
            var id_kelas = $(this).val();
           

            if (id_kelas) {
                $('#table-ukgs').DataTable().clear().destroy();
                

                load_data(id_kelas);
            } else {
                $('#table-ukgs').DataTable().clear().destroy();


            }
        });

        
        

    
});



</script>


@endpush