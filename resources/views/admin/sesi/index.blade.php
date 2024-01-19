@extends('layout.master')
@section('content')

<!-- Content area -->
<div class="card">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div class="card-title h-auto m-0">
                <h4 class="m-0">Jadwal {{ $dataJadwalPoli[0]->poli->poli }}

                </h4>
            </div>
            <a href="/" id="btn-create" class="btn btn-primary w-auto">Tambah sesi</a>
        </div>
        <div class="row m-0">
            @foreach ($dataJadwalPoli as $key => $value)
            <input type="radio" class="btn-check" name="klinik_hari" id="data{{$value->hari_id}}" value="{{$value->id}}"
            @if ($value->hari['id'] === 1)
                checked
            @endif>
            <label class="col btn btn-outline-success m-1" for="data{{$value->hari_id}}">
                {{$value->hari['hari']}}
            </label>
            @endforeach
        </div>
        <hr />
        <div class="table-responsive">
            <table id="table-jadwal-klinik" class="table " style="width:100%">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th width="10px">No</th>
                        <th>Sesi</th>
                        <th>Waktu Mulai</th>
                        <th>Waktu Selesai</th>
                        <th>Jumlah Dokter</th>
                        <th class="col-md-2">Aksi</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
</div>
<!-- /content area -->
@endsection

@push('after-script')

<script  type="text/javascript">
var tableData, hariChecked;

// Set button "Tambah sesi"
// href url to admin/klinik/{idKlinik}/sesi/create?sesiHari={idHari}
function setHari() {
    hariChecked = $("input[name='klinik_hari']:checked").val();
    $('#btn-create').attr("href", "{{ url('admin/klinik/'.$dataJadwalPoli[0]->poli->id.'/sesi/create') }}"+"?sesiHari="+hariChecked);
}

$(document).ready(function() {
    setHari();
    $("input[name='klinik_hari']").change(function() {
        setHari();
        tableSesi.draw(true);
    });
    /* tabel user */
    tableSesi = $('#table-jadwal-klinik').DataTable({
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
            url: "{{url('admin/table/data-sesi')}}",
            type: "GET",
            data: function(d) {
                d.klinik_hari = $("input[name='klinik_hari']:checked").val();
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
                data: 'sesi',
                name: 'sesi',
                visible: true
            },
            {
                data: 'mulai',
                name: 'mulai',
                visible: true
            },
            {
                data: 'selesai',
                name: 'selesai',
                visible: true
            },
            {
                data: 'jumlah_dokter',
                name: 'jumlah_dokter',
                visible: true
            },
            {
                data: 'action',
                name: 'action',
                visible: true
            },
        ],
    });
    $('#table-jadwal-klinik tbody').on( 'click', 'button', function () {
        var data = tableSesi.row( $(this).parents('tr') ).data();
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
                    url: "{{ url('delete/sesi') }}"+"/"+data['id'],
                    method: 'get',
                    success: function(result){
                        tableSesi.ajax.reload();
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
