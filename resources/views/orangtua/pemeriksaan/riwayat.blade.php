@extends('layout.master')

@section('content')



<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-10 col-sm-6">
                <div class="card-title">
                    <h4 class="mb-0">Riwayat Pemeriksaan </h4>
                </div>
            </div>
            <div class="col-md-2 col-sm-6">
                <select class=" form-select" id="anak" name="anak" data-width="100%">
                    <option value="clear">Pilih Pasien</option>
                    @foreach($anak as $anak)

                    <option value="{{$anak->id}}">{{$anak->nama}}</option>
                    @endforeach
                </select>

            </div>
        </div>
        <hr />
        <ul class="nav nav-tabs nav-tabs-line" id="lineTab" role="tablist">

            <li class="nav-item">
                <a class="nav-link active " id="gigi-line-tab" data-bs-toggle="tab" href="#gigi" role="tab"
                    aria-controls="gigi" aria-selected="false">Gigi</a>
            </li>
            {{-- <li class="nav-item">
                <a class="nav-link " id="home-line-tab" data-bs-toggle="tab" href="#home" role="tab"
                    aria-controls="home" aria-selected="true">Fisik</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="profile-line-tab" data-bs-toggle="tab" href="#profile" role="tab"
                    aria-controls="profile" aria-selected="false">Mata</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="contact-line-tab" data-bs-toggle="tab" href="#contact" role="tab"
                    aria-controls="contact" aria-selected="false">Telinga</a>
            </li> --}}

        </ul>
        <div class="tab-content mt-3" id="lineTabContent">
        <div class="tab-pane fade show active" id="gigi" role="tabpanel" >
                <div class="table-responsive">
                    <table id="table-gigi" class="table  table-striped table-bordered " style="width:100%">
                        <thead>
                            <tr class="col-lg-12">
                                <th>id</th>
                                <th >no</th>
                                <th>Tanggal</th>
                                <th >Waktu</th>
                                <th >Hasil Pemeriksaan</th>
                                <th>Rekomendasi</th>
                                <th>Action </th>
                            </tr>
                        </thead>
                        <tbody class="col-lg-12">

                        </tbody>
                    </table>
                </div>
            </div>

            {{--
            <div class="tab-pane fade " id="home" role="tabpanel" aria-labelledby="home-line-tab">
                <div class="">
                    <table id="table-fisik" class="table table-striped table-bordered " style="width:100%">
                        <thead>
                            <tr class="col-lg-12">
                                <th>id</th>
                                <th style="width: 1px;">no</th>
                                <th>Tanggal</th>
                                <th>Waktu</th>
                                <th>Hasil Pemeriksaan</th>
                            </tr>
                        </thead>
                        <tbody class="col-lg-12"></tbody>
                    </table>
                </div>

            </div>
            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-line-tab">
                <div class="">
                    <table id="table-mata" class="table table-striped table-bordered " style="width:100%">
                        <thead>
                            <tr class="col-lg-12">
                                <th>id</th>
                                <th style="width: 1px;">no</th>
                                <th>Tanggal</th>
                                <th>Waktu</th>
                                <th>Hasil Pemeriksaan</th>
                            </tr>
                        </thead>
                        <tbody class="col-lg-12"></tbody>
                    </table>
                </div>
            </div>
            <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-line-tab">
                <div class="">
                    <table id="table-telinga" class="table table-striped table-bordered " style="width:100%">
                        <thead>
                            <tr class="col-lg-12">
                                <th>id</th>
                                <th style="width: 1px;">no</th>
                                <th>Tanggal</th>
                                <th>Waktu</th>
                                <th>Hasil Pemeriksaan</th>

                            </tr>
                        </thead>
                        <tbody class="col-lg-12"></tbody>
                    </table>
                </div>
            </div>

            --}}

        </div>
    </div>
</div>

@include('orangtua.pemeriksaan.foto')
@endsection

@push('after-script')

<script type="text/javascript">
    var tableData;
    var tableDataMata;
    var tableDataTelinga;
    var tableDataGigi;
    let filter;

    $(document).ready(function () {
        $('#anak').select2({
            placeholder: 'Pilih anak',

        });
        if ($('#anak').val() == 'null') {
            $('#table-fisik').DataTable({
                "oLanguage": {
                    "sEmptyTable": "Silakan pilih anak terlebih dahulu",
                },
            }).clear();
            $('#table-mata').DataTable({
                "oLanguage": {
                    "sEmptyTable": "Silakan pilih anak terlebih dahulu",
                },
            }).clear();
            $('#table-telinga').DataTable({
                "oLanguage": {
                    "sEmptyTable": "Silakan pilih anak terlebih dahulu",
                },
            }).clear();
            $('#table-gigi').DataTable({
                "oLanguage": {
                    "sEmptyTable": "Silakan pilih anak terlebih dahulu",
                },
            }).clear();



        } else {
            $('#table-fisik').DataTable({
                "oLanguage": {
                    "sEmptyTable": "Silakan pilih anak terlebih dahulu",
                },
            }).clear();
            $('#table-mata').DataTable({
                "oLanguage": {
                    "sEmptyTable": "Silakan pilih anak terlebih dahulu",
                },
            }).clear();
            $('#table-telinga').DataTable({
                "oLanguage": {
                    "sEmptyTable": "Silakan pilih anak terlebih dahulu",
                },
            }).clear();
            $('#table-gigi').DataTable({
                "oLanguage": {
                    "sEmptyTable": "Silakan pilih pasien terlebih dahulu",
                },
            }).clear();


        }


        function load_data(anak = '') {

            /*

            tableData = $('#table-fisik ').DataTable({
                "oLanguage": {
                    "sEmptyTable": "Silakan pilih anak terlebih dahulu",
                    "zeroRecords": "Data tidak ditemukan",
                },
                processing: true,
                serverSide: true,


                language: {
                    "lengthMenu": "Tampilkan _MENU_ entri",
                    "paginate":{
                    "next":"Selanjutnya",
                    "previous":"Sebelumnya"

                },
                    search: "_INPUT_",
                    searchPlaceholder: "Cari",
                    processing: `<div class="spinner-border text-primary" role="status">
                             <span class="visually-hidden">Loading...</span>
                            </div>`
                },
                "ordering": true,
                "order": [
                    [0, "DESC"]
                ],

                "searching": false,
                "bPaginate": true,

                serverSide: true,
                stateSave: true,
                ajax: {
                    url: "{{ url('admin/table/data-pemeriksaan-fisik') }}",
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
                        data: 'jam',
                        name: 'jam',
                        visible: true
                    },
                    {
                        data: 'imt',
                        name: 'imt',
                        visible: true
                    },




                ],
                "columnDefs": [{
                    "targets": 0,
                    "type": "date-eu"

                }],


            });
            tableDataMata = $('#table-mata').DataTable({
                "oLanguage": {
                    "sEmptyTable": "Silakan pilih anak terlebih dahulu",
                    "zeroRecords": "Data tidak ditemukan",
                },
                processing: true,
                serverSide: true,


                language: {
                    "lengthMenu": "Tampilkan _MENU_ entri",
                "paginate":{
                    "next":"Selanjutnya",
                    "previous":"Sebelumnya"
                },
                    search: "_INPUT_",
                    searchPlaceholder: "Cari",
                    processing: `<div class="spinner-border text-primary" role="status">
                             <span class="visually-hidden">Loading...</span>
                            </div>`,

                },
                "searching": false,
                "bPaginate": true,
                serverSide: true,
                stateSave: true,
                ajax: {
                    url: "{{ url('admin/table/data-pemeriksaan-mata') }}",
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
                        data: 'jam',
                        name: 'jam',
                        visible: true
                    },
                    {
                        data: 'hasil',
                        name: 'hasil',
                        visible: true
                    }


                ],
                order: [
        [2, 'desc'] // Mengurutkan berdasarkan kolom tanggal (index 2) secara menurun (dari yang terbaru)
    ]

            });
            tableDataTelinga = $('#table-telinga').DataTable({
                "oLanguage": {
                    "sEmptyTable": "Silakan pilih anak terlebih dahulu",
                    "zeroRecords": "Data tidak ditemukan",
                },
                processing: true,
                serverSide: true,


                language: {
                    "lengthMenu": "Tampilkan _MENU_ entri",
                    "paginate":{
                    "next":"Selanjutnya",
                    "previous":"Sebelumnya"
                },
                    search: "_INPUT_",
                    searchPlaceholder: "Cari",
                    processing: `<div class="spinner-border text-primary" role="status">
                             <span class="visually-hidden">Loading...</span>
                            </div>`
                },
                "searching": false,
                "bPaginate": true,
                serverSide: true,
                stateSave: true,
                ajax: {
                    url: "{{ url('admin/table/data-pemeriksaan-telinga') }}",
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
                        data: 'jam',
                        name: 'jam',
                        visible: true
                    },
                    {
                        data: 'hasil',
                        name: 'hasil',
                        visible: true
                    }


                ],

            });

            */

            tableDataGigi = $('#table-gigi').DataTable({
                "oLanguage": {
                    "sEmptyTable": "Silakan pilih anak terlebih dahulu",
                    "zeroRecords": "Data tidak ditemukan",
                },
                processing: true,


                "scrollX": true,

                language: {
                    "lengthMenu": "Tampilkan _MENU_ entri",
                    "paginate":{
                    "next":"Selanjutnya",
                    "previous":"Sebelumnya"
                },
                    search: "_INPUT_",
                    searchPlaceholder: "Cari",
                    processing: `<div class="spinner-border text-primary" role="status">
                             <span class="visually-hidden">Loading...</span>
                            </div>`
                },

                "searching": false,
                "bPaginate": true,
                serverSide: true,
                stateSave: true,
                ajax: {
                    url: "{{ url('admin/table/data-pemeriksaan-gigi') }}",
                    type: "GET",
                    data: {
                        anak: anak
                    }
                },


                columns: [
                    {
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
                        data: 'jam',
                        name: 'jam',
                        visible: true
                    },
                    {
                        data:'diagnosa',
                        name:'diagnosa',
                        visible:true,

                    },
                    {
                        data:'rekomendasi',
                        name:'rekomendasi',
                        visible:true,

                    },
                    {
                        data:'action',
                        name:'action',
                        visible:true,
                    },


                ],
                columnDefs: [
                {
                    render: function (data, type, full, meta) {
                        return "<div class='text-wrap width-300'>" + data + "</div>";
                    },
                    targets: [5,6]
                },
                {
                    render: function (data, type, full, meta) {
                        return "<div class='text-wrap width-400'>" + data + "</div>";
                    },
                    targets: [4]
                },
                {
                    "targets": 0,
                    "type": "date-eu"

                }

             ],
             order: [
        [2, 'desc'] // Mengurutkan berdasarkan kolom tanggal (index 2) secara menurun (dari yang terbaru)
            ]

            });

            $("#table-gigi tbody").on('click', '#show-foto', function () {
            $('.fileinput-remove-button').click();
            $('#modal-foto').modal('show');

            var data = tableDataGigi.row($(this).parents('tr')).data();


            $('#gigi1, #gigi2, #gigi3, #gigi4, #gigi5').empty();

            // Append images to their respective divs
            // Ini untuk mengisi gambar yang di riwayat pemeriksaan
            $('#gigi1').append($('<img id="img-gigi" class="mb-1 img-fluid mx-auto d-block" src="/storage/gigi/' + data['gambar1'] + '" alt="" title="" width="200">'));
            $('#gigi2').append($('<img id="img-gigi" class="mb-1 img-fluid mx-auto d-block" src="/storage/gigi/' + data['gambar2'] + '" alt="" title="" width="200">'));
            $('#gigi3').append($('<img id="img-gigi" class="mb-1 img-fluid mx-auto d-block" src="/storage/gigi/' + data['gambar3'] + '" alt="" title="" width="200">'));
            $('#gigi4').append($('<img id="img-gigi" class="mb-1 img-fluid mx-auto d-block" src="/storage/gigi/' + data['gambar4'] + '" alt="" title="" width="200">'));
            $('#gigi5').append($('<img id="img-gigi" class="mb-1 img-fluid mx-auto d-block" src="/storage/gigi/' + data['gambar5'] + '" alt="" title="" width="200">'));


            if (!data['gambar4']) {
                $('#title4').hide();
            }
            if (!data['gambar5']) {
                $('#title5').hide();
            }
            });
        }

        $('#anak').change(function () {
            var anak = $(this).val();

            if (anak) {
                $('#table-fisik').DataTable().clear().destroy();
                $('#table-mata').DataTable().clear().destroy();
                $('#table-telinga').DataTable().clear().destroy();
                $('#table-gigi').DataTable().clear().destroy();

                load_data(anak);
            } else {
                $('#table-fisik').DataTable().clear().destroy();
                $('#table-mata').DataTable().clear().destroy();
                $('#table-telinga').DataTable().clear().destroy();
                $('#table-gigi').DataTable().clear().destroy();

            }
        });



    })

</script>
@endpush
