<div class="modal fade" id="modal-edit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" >Ubah Sekolah</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
        </div>
        <form class="form-horizontal" id="sekolah-edit" method="post" enctype="multipart/form-data" files=true>  
            @method('PUT')
            @csrf      
        <div class="modal-body">
            <input type="hidden" name="id_edit">

            <div class="mb-3">
                <label class="form-label">Kecamatan</label>
                <select class="js-example-basic-single form-select" name="kecamatan_edit" data-width="100%">
                    @foreach(\App\Models\Kecamatan::get() as $value => $key)
              
                    <option value="{{$key->id}}">{{$key->nama}}</option>
                @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Kelurahan</label>
                <select class="js-example-basic-single form-select" name="kelurahan_edit" data-width="100%">
                    @foreach(\App\Models\Kelurahan::get() as $value => $key)
              
                    <option value="{{$key->id}}">{{$key->nama}}</option>
                @endforeach
                </select>
            </div>
            <div class="mb-3">
                <div class="form-group">
                    <label>Sekolah</label>
                    <input type="text"  name="nama_edit" class="form-control"
                        placeholder="">
                </div>
            </div>
            <div class="mb-3">
                <div class="form-group">
                    <label>Alamat</label>
                    <input type="text"  name="alamat_edit" class="form-control"
                        placeholder="">
                </div>
            </div>

        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Simpan</button>
            <button type="button" class="btn btn-secondary"  data-bs-dismiss="modal">Batal</button>
        </div>
        </form>
      </div>
    </div>
  </div>
@push('after-script')
<script type="text/javascript">
    $(document).ready(function () {
        /* save data */
        $('#sekolah-edit').on('submit', function (e) {
      e.preventDefault();
        $.ajax({
            'type': 'post',
            'url' : "{{ url('admin/sekolah') }}"+"/"+$('input[name=id_edit]').val(),
            'data': new FormData(this),
            'processData': false,
            'contentType': false,
            'dataType': 'JSON',
            'success': function(data){
                if(data.success){
                    $('#modal-edit').modal('hide');
                    Swal.fire({
                        icon: 'success',
                        title: 'Data berhasil diubah',
                        showConfirmButton: false,
                        timer: 1500
                            });
                    tableData.ajax.reload();
                }else{
                    for(var count = 0; count < data.errors.length; count++){
                        swal(data.errors[count], {
                            icon: "error",
                            timer: false,
                        });
                    }
                }
            },

        });
    });
    });

</script>
@endpush