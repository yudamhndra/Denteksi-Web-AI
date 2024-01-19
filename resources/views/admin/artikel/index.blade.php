@extends('layout.master')

@section('content')

<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-10">
               	<div class="card-title">
								<h4 class="mb-0">Artikel</h4>
							</div>
            </div>
            <div class="col-2">
            <a href="{{route('artikel.create')}}" type="button" id="btn-create"  class="btn btn-custom text-white">Tambah data</a>
            </div>
        </div>
        <hr />
			<div class="table-responsive">
            <table id="table-artikel" class="table " style="width:100%" >
                <thead>
                    <tr>
						<th>id</th>
                        <th style="width: 1px;">no</th>
                        <th>Judul</th>
                        <th>Gambar</th>
                        <th>action</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
</div>

@include('admin.artikel.artikel')
@endsection

@push('after-script')

<script  type="text/javascript">
var tableData;

$(document).ready(function () {

    $('.dropify').dropify({
    messages: {
        'default': 'Drag and drop a file here or click',
        'replace': 'Drag and drop or click to replace',
        'remove':  'Hapus',
        'error':   'Ooops, something wrong happended.'
    }
    })
    $("#btn-create").on('click', function(){
          $('.fileinput-remove-button').click();
          $('input[name=nama]').val('');
          $('#modal-create').modal('show');


      });
        tableData = $('#table-artikel').DataTable({
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
            order: [ 0, 'desc' ],
			"searching": true,
            "bPaginate": true,
            serverSide: true,
            stateSave: true,
            ajax: {
                url: "{{ url('admin/table/data-artikel') }}",
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
                    data: 'judul',
                    name: 'judul',
                    visible: true
                },
                {
                    data: 'gambar',
                    name: 'gambar',
                    visible: true
                },

                 { data: 'action', name:'action', visible:true},

            ],

        });

        $("#table-artikel tbody").on('click','#btn-edit', function(){
          $('.fileinput-remove-button').click();
          $('#modal-edit').modal('show');

          var data = tableData.row( $(this).parents('tr') ).data();
          var id = data['id'];
          var token = $('input[name=_token]').val();

          $('input[name=_method]').val('PUT');
          $('input[name=_token]').val(token);
          $('input[name=id_edit]').val(data['id']);
          $('input[name=judul_edit]').val(data['judul']);



        });

        $('#table-artikel tbody').on('click','#btn-pdf',function(){

            var data = tableData.row( $(this).parents('tr') ).data();
            var id = data['id'];
            var judul = data['judul']
            $('#modal-pdf').modal('show');

            $('#modal-pdf').on('shown.bs.modal', function (e) {
            $('#artikel-in-modal').attr('src', '/storage/artikel/'+data['artikel']);
            $('#judul-artikel').empty(judul);
            $('#judul-artikel').append(judul);
            });
            $('#modal-pdf').on('hide.bs.modal', function (e) {
            $("#artikel-in-modal").attr('src','');
            });

        })



        $('#table-artikel tbody').on( 'click', '#btn-delete', function () {
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
              url: "{{ url('delete/artikel') }}"+"/"+data['id'],
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
