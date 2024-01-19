@extends('layout.master')

@section('content')
<style>
/* Tambahkan CSS berikut di bagian <head> atau file CSS terpisah */

/* Style untuk tombol di mode desktop */
@media only screen and (min-width: 768px) {

}

/* Style untuk tombol di mode responsif (telepon) */
@media only screen and (max-width: 767px) {

    .btn-create-excel {

    }

    .btn-group .btn {
        font-size: 0;
    }
    .btn-create {
        font-size: 0;
        padding-right: 3px;
    }
    #btn-create-excel i,
    .dropdown-menu button i {
        margin-right: 0;
    }
}
</style>


<div class="card card-table" style="margin-top: 40px;">
    <div class="row">
        <div class="col-md-6 col-sm-6">
            <button href="{{route('pdfStream')}}" type="button" id="btn-create-excel" target="_blank" class="btn btn-submit-white btn-create-excel btn-rounded text-left" onclick="cetakQR()">
                <i class="fas fa-qrcode" style="margin-right: 10px;"></i>
                Cetak QR
            </button>
        </div>
        <div class="col-md-6 col-sm-6">
            <div class="d-flex justify-content-end">
                <div class="btn-group" style="margin-right: 10px;">
                    <button type="button" class="btn btn-submit-white btn-rounded dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-file" style="margin-right: 10px;"></i> Import Excel
                    </button>
                    <div class="dropdown-menu" style="top: 100%; padding: 20px; width: 200px; border-radius: 30px;">
                        <div>
                            <button class="dropdown-item" type="button" id="btn-import-excel" style="color:#29A1B1;">
                                <i class="fas fa-upload" style="margin-right: 10px; color:#29A1B1;"></i>
                                <p class="text-import-excel">Import Excel</p>
                            </button>
                            <button class="dropdown-item" type="button" id="btn-download-excel" style="color:#29A1B1;" onclick="downloadTemplate()">
                                <i class="fas fa-file-excel" style="margin-right: 10px; color:#29A1B1;"></i>
                                <p class="text-download-template">Download Template</p>
                            </button>
                            <input type="file" id="fileInput" style="display: none">
                        </div>
                    </div>
                </div>
                <button type="create" id="btn-create" class="btn-create btn btn-submit-col" onclick="tambahAnak()">
                    <i class="fas fa-plus" style="margin-right: 10px;"></i>
                    Tambah Anak
                </button>
            </div>
        </div>
    </div>
    <hr />
    <div class="table-responsive"  style="margin-bottom: 20px;">
        <table id="table-anak" class="table">
            <thead>
                <tr>
                    <th>id</th>
                    <th style="width: 1px;">no</th>
                    <th>Nama Anak</th>
                    <th>Jenis Kelamin</th>
                    <th>Tanggal Lahir</th>
                    <th>action</th>
                </tr>
            </thead>
            <tbody>
                <!-- Table content goes here -->
            </tbody>
        </table>
    </div>
</div>


@endsection

@push('after-script')

<script  type="text/javascript">
var tableData;
var formData;

function downloadTemplate() {
    window.location.href = "{{ route('downloadSpreadsheet')}}"
}


function cetakQR() {
    var selectedRowsData = tableData.rows({ selected: true }).data().toArray();
    var selectedDataToSend = selectedRowsData.map(function (row) {
        return {
            id: row.id,
            nama: row.nama,
            tanggal: row.tanggal_lahir
        };
    });

    var dataInJson = JSON.stringify(selectedDataToSend);
    var url = "/orangtua/cetakQR?data=" + encodeURIComponent(dataInJson);
    // window.location.href = url;
    window.open(url)
}


$(document).on('click', '#btn-create-excel', function(e) {
    e.preventDefault();

    // Mengambil URL untuk PDF dari server
    $.ajax({
        url: '/get-pdf-url',
        method: 'GET',
        success: function(response) {
            // Membuka URL PDF di tab baru
            window.open(response.url, '_blank');
        },
        error: function(error) {
            console.error('Error:', error);
        }
    });
});


$(document).ready(function () {

        tableData =
        $('#table-anak').DataTable({
            processing: true,
			serverSide: true,
            responsive: true,
            select: {
                style: 'multi',
                selector: 'tr',
                classname: 'selected',
                info: false,
            },
            language: {
                "lengthMenu": "Tampilkan _MENU_ entri",
                "paginate":{
                    "next":"Selanjutnya",
                    "previous":"Sebelumnya"
                },
                search: "Search :_INPUT_",
                searchPlaceholder: "cari"
            },
			"searching": true,
            "bPaginate": true,
            serverSide: true,
            stateSave: true,
            ajax: {
                url: "{{ url('orangtua/table/data-anak') }}",
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
                    data: 'tanggal_lahir',
                    name: 'tanggal_lahir',
                    visible: true
                },
                 { data: 'action', name:'action', visible:true},

            ],

        });

        $('#table-anak tbody').on( 'click', '#btn-delete', function () {
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
              url: "{{ url('delete/orangtua-anak') }}"+"/"+data['id'],
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

      $(document).ready(function () {
        $('.dropdown-toggle').dropdown();

        $('.dropdown-toggle').on('click', function () {
            $(this).next('.dropdown-menu').toggleClass('show');
        });

        $(document).on('click', function (e) {
            if ($(e.target).closest('.dropdown-toggle').length === 0) {
                $('.dropdown-menu').removeClass('show');
            }
        });
     });

     $(document).on('click', '#btn-create', function() {
    window.location.href = "{{ route('view-anak.create') }}";
    });

    $(document).on('click', '#btn-import-excel', function () {
    // Trigger click event on the hidden file input
    $('#fileInput').click();
    });

    // Handle file change event
    $('#fileInput').on('change', function () {
    // Add your logic to handle the selected file
    var formData = new FormData();
    var selectedFile = $(this).prop('files')[0];

    if (selectedFile) {
        formData.append('excel_file', selectedFile);
        formData.append('_token', '{{ csrf_token() }}'); // Add CSRF token

        $.ajax({
            url: "{{ route('saveSpreadsheet') }}",
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                console.log(response);
                location.reload();
                // Handle success
            },
            error: function (error) {
                console.error(error);
                // Handle error
            }
        });
        } else {
        console.log('No file selected.');
        }
    });
})
</script>
@endpush
