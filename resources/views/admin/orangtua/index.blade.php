@extends('layout.master')

@section('navbar-title')
Orangtua
@endsection
@section('content')

<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-10">
               	<div class="card-title">
								<h4 class="mb-0">Orangtua</h4>
							</div>
            </div>
            <div class="col-2">
            <a href="{{route('orangtua.create')}}" type="button" id="btn-create"  class="btn btn-custom text-white">Tambah data</a>
            </div>
        </div>
        <hr />
			<div class="table-responsive">
            <table id="table-orangtua" class="table " style="width:100%" >
                <thead>
                    <tr>
						<th>id</th>
                        <th style="width: 1px;">no</th>
                        <th>email</th>
                        <th>nama</th>
                        <th>alamat</th>
                        <th>pendidikan</th>
                        <th>action</th>
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
        tableData = $('#table-orangtua').DataTable({
            processing: true,
			serverSide: true,
            responsive: true,
            language: {
                "lengthMenu": "Tampilkan _MENU_ entri",
                "paginate":{
                    "next":"Selanjutnya",
                    "previous":"Sebelumnya"
                },
                search: "_INPUT_",
                searchPlaceholder: "Cari"
            },
			"searching": true,
            "bPaginate": true,
            serverSide: true,
            stateSave: true,
            ajax: {
                url: "{{ url('admin/table/data-orangtua') }}",
                type: "GET",
            },
            columns: [{
                    data: 'id',
                    name: 'id',
                    visible: false
                },
				{
					data: 'DT_RowIndex', name:'DT_RowIndex', visible:true
				},
                {
                    data: 'email',
                    name: 'email',
                    visible: true
                },
                {
                    data: 'nama',
                    name: 'nama',
                    visible: true
                },
                {
                    data: 'alamat',
                    name: 'alamat',
                    visible: true
                },
                {
                    data: 'pendidikan',
                    name: 'pendidikan',
                    visible: true
                },
                 { data: 'action', name:'action', visible:true},

            ],

        });

        $('#table-orangtua tbody').on( 'click', '#btn-delete', function () {
        var data = tableData.row( $(this).parents('tr') ).data();
       Swal.fire({
            title: 'Harap Konfirmasi',
            text: "Anda tidak dapat mengembalikan data yang telah dihapus!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Lanjutkan'
        }).then((willDelete) => {
          if (willDelete.isConfirmed) {
            $.ajax({
              url: "{{ url('delete/orangtua') }}"+"/"+data['id'],
              method: 'get',
              success: function(result){
                tableData.ajax.reload();
                Swal.fire(
                'Hapus',
                  'Data Berhasil di hapus.',
                 'success'
                 )
              }

            });
          }
        });
      });
        


})
</script>
@endpush