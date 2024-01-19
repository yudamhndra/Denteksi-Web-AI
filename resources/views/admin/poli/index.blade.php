@extends('layout.master')
@section('content')

<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-10">
               	<div class="card-title">
                    <h4 class="mb-0">Jadwal Layanan</h4>
                </div>
            </div>
            <div class="col-2">
            <a href="{{route('klinik.create')}}"  id="btn-create" class="btn btn-primary">Tambah data</a>
            </div>
        </div>
        <hr />
			<div class="table-responsive">
            <table id="table-klinik" class="table "  style="width:100%">
                <thead>
                    <tr>
						<th>Id</th>
                        <th width="10px">No</th>
                        <th>Layanan Kesehatan</th>
                        <th>Kode</th>
                        <th>Waktu (Menit)</th>
                        <th class="col-md-2">Jadwal</th>
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
    tableData = $('#table-klinik').DataTable({
        processing: true,
        serverSide: true,
        responsive: true,
        stateSave: true,
        "searching": true,
        "bPaginate": true,
        language: {
            search: "_INPUT_",
            searchPlaceholder: "Cari"
        },
        ajax: {
            url: "{{ url('admin/table/data-poli') }}",
            type: "GET",
        },
        columns: [
            { data: 'id', name:'id', visible:false},
            { data: 'DT_RowIndex', name:'DT_RowIndex', visible:true},
            { data: 'poli', name:'poli', visible:true},
            { data: 'kode', name:'kode', visible:true},
            { data: 'waktu', name:'waktu', visible:true},
            { data: 'jadwal', name:'jadwal', visible:true},
            { data: 'action', name:'action', visible:true},
        ],
    });
    $('#table-klinik tbody').on( 'click', 'button', function () {
        var data = tableData.row( $(this).parents('tr') ).data();
        Swal.fire({
            title: 'Harap Konfirmasi',
            text: "Apakah Anda yakin ingin menghapus data ini? Data yang telah dihapus tidak dapat dikembalikan.",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Lanjutkan'
        })
        .then((willDelete) => {
            if (willDelete.isConfirmed) {
                $.ajax({
                    url: "{{ url('delete/klinik') }}"+"/"+data['id'],
                    method: 'get',
                    success: function(result){
                        tableData.ajax.reload();
                        Swal.fire(
                            'Hapus',
                            'Data Berhasil di hapus.',
                            'success'
                        );
                    }
                });
            } else {
                Swal.fire({
                    title: "Data Anda aman!",
                    showConfirmButton: false,
                    timer: 1200    
                });
            }
        });
    });
})
</script>
@endpush