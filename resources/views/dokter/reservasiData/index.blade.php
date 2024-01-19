@extends('layout.master')
@section('content')

<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-10">
               	<div class="card-title">
                    <h4 class="mb-0">Daftar Data Reservasi Pasien</h4>
                </div>
            </div>
        </div>
        <hr />
			<div class="table-responsive">
            <table id="table-reservasi-ortu" class="table "  style="width:100%">
                <thead>
                    <tr>
						<th>Id</th>
                        <th>Kode</th>
                        <th>Layanan Kesehatan</th>
                        <th width="20px">Tanggal</th>
                        <th width="10px">No Antrian</th>
                        <th>Nama</th>
                        <th>Keluhan</th>
                        <th width="20px">Status</th>
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
        orderMulti: false,
        stateSave: true,
        "orderFixed": {
            "pre": [ 3, 'asc' ],
            "pre": [ 4, 'desc' ]
        },
        "searching": true,
        "bPaginate": true,
        language: {
            search: "_INPUT_",
            searchPlaceholder: "Cari"
        },
        ajax: {
            url: "{{ url('dokter/data-reservasi') }}",
            type: "GET",
        },
        columns: [
            { data: 'id', name:'id', visible:false},
            { data: 'kode', name:'kode', visible:true},
            { data: 'poli', name:'poli', visible:true},
            { data: 'tanggal', name:'tanggal', visible:true},
            { data: 'antrian', name:'antrian', visible:true},
            { data: 'nama', name:'nama', visible:true},
            { data: 'keluhan', name:'keluhan', visible:true},
            { data: 'status', name:'status', visible:true},
        ],
    });
})
</script>
@endpush
