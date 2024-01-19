<div class="modal fade" id="modal-create" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Sekolah</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
            </div>
            <form class="form-horizontal" id="posyandu-store" method="post" enctype="multipart/form-data" files=true>
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Kecamatan</label>
                        <select class="form-select" name="kecamatan" id="id_kecamatan" data-width="100%">
                            <option class="mb-2" value=" ">---Pilih Kecamatan---</option>
                            @foreach(\App\Models\Kecamatan::get() as $value => $key)

                            <option value="{{$key->id}}">{{$key->nama}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Kelurahan</label>
                        <select class="form-select" name="kelurahan" data-width="100%" id="id_desa">

                        </select>
                    </div>

                    <div class="mb-3">
                        <div class="form-group">
                            <label>Nama</label>
                            <input type="text" name="nama" class="form-control" placeholder="">
                        </div>
                    </div>

                    <div class="mb-3">
                        <div class="form-group">
                            <label>Alamat</label>
                            <input type="text" name="alamat" class="form-control" placeholder="">
                        </div>
                    </div>
                   

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    
                </div>
            </form>
        </div>
    </div>
</div>
@push('after-script')
<script type="text/javascript">
    $(document).ready(function () {
        /* save data */
        $('#posyandu-store').on('submit', function (e) {
            e.preventDefault();
            $.ajax({
                'type': 'POST',
                'url': "{{ route('posyandu.store') }}",
                'data': new FormData(this),
                'processData': false,
                'contentType': false,
                'dataType': 'JSON',
                'success': function (data) {
                    if (data.success) {
                        $('#modal-create').modal('hide');

                        Swal.fire({
                            icon: 'success',
                            title: 'Data berhasil ditambahkan',
                            showConfirmButton: false,
                            timer: 1500
                        });
                        tableData.ajax.reload();
                    } else {
                        for (var count = 0; count < data.errors.length; count++) {
                            swal(data.errors[count], {
                                icon: "error",
                                timer: false,
                            });
                        }
                    }
                },

            });
        });
        
        $('#id_kecamatan').change(function () {
            let kecamatan = $("#id_kecamatan").val()
            $("#id_desa").children().remove();
            $("#id_desa").val('');
            $("#id_desa").append('<option value="">---Pilih Kelurahan---</option>');
            $("#id_desa").prop('disabled', true)
            if (kecamatan != '' && kecamatan != null) {
                $.ajax({
                    url: "{{url('')}}/list-desa/" + kecamatan,
                    success: function (res) {
                        $("#id_desa").prop('disabled', false)
                        let tampilan_option = '';
                        $.each(res, function (index, desa) {
                            tampilan_option +=
                                `<option value="${desa.id}">${desa.nama}</option>`
                        })
                        $("#id_desa").append(tampilan_option);
                    },
                });
            }
        });








    });

</script>
@endpush
