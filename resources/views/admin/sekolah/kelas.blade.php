@extends('layout.master')

@section('content')

<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-10">
               	<div class="card-title">
								<h4 class="mb-0">Sekolah</h4>
							</div>
            </div>
            <div class="col-2">
            <button type="button" id="btn-create" class="btn btn-custom text-white">Tambah data</button>
            </div>
        </div>
        <hr />
			<div class="table-responsive">
            <table id="table-kelas" class="table "  style="width:100%">
                <thead>
                    <tr>
						<th>id</th>
                        <th style="width: 1px;">no</th>
                        <th>Sekolah</th>
                        <th>Kelas</th>
                        
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
    
    tableData = $('#table-kelas').DataTable({
    processing: true,
    serverSide: true,
    responsive: true,
    language: {
        search: "_INPUT_",
        searchPlaceholder: "Cari"
    },
    searching: true,
    bPaginate: true,
    stateSave: true,
    ajax: {
        url: "{{ route('kelas.table', ['id' => $sekolah->id]) }}",
        type: "GET"
    },
    columns: [
        { data: 'id', name: 'id' ,visible: false},
        { data: 'DT_RowIndex', name: 'DT_RowIndex' },
        { data: 'sekolah', name: 'sekolah' },
        { data: 'kelas', name: 'kelas' },
        
    ]
});
});





</script>

@endpush
