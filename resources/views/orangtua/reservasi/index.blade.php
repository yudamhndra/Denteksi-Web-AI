@extends('layout.master')
@section('content')

<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-10">
               	<div class="card-title">
                    <h4 class="mb-0">Riwayat Reservasi</h4>
                </div>
            </div>
        </div>
        <hr />
			<div class="table-responsive">
            <table id="table-reservasi-ortu" class="table "  style="width:100%">
                <thead>
                    <tr>
						<th>Id</th>
                        <th width="10px">No Antrian</th>
                        <th>Layanan Kesehatan</th>
                        <th>Jadwal Pelayanan</th>
                        <th>Status</th>
                        <th class="col-md-2">Aksi</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@push('after-script')

<script  type="text/javascript">
var tableData;

$(document).ready(function () {
    tableData = $('#table-reservasi-ortu').DataTable({
        processing: true,
        serverSide: true,
        responsive: true,
        // orderMulti: false,
        // stateSave: true,
        // "orderFixed": {
        //     "pre": [ 4, 'asc' ],
        //     "pre": [ 3, 'desc' ]
        // },
        language: {
            "lengthMenu": "Tampilkan _MENU_ entri",
                "paginate":{
                    "next":"Selanjutnya",
                    "previous":"Sebelumnya"
                },
            search: "Search : _INPUT_",
            searchPlaceholder: "Cari"
        },
        "searching": true,
        "bPaginate": true,
        ajax: {
            url: "{{ url('orangtua/table/data-reservasi') }}",
            type: "GET",
        },
        columns: [
            { data: 'id', name:'id', visible:false},
            { data: 'antrian', name:'antrian', visible:true},
            { data: 'poli', name:'poli', visible:true},
            { data: 'sesi', name:'sesi', visible:true},
            { data: 'status', name:'status', visible:true},
            { data: 'action', name:'action', visible:true},
        ],
    });
})
</script>
@endpush
