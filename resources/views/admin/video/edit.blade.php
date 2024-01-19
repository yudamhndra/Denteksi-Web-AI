<div class="modal fade" id="modal-edit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" >Ubah Video</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
        </div>
        <form class="form-horizontal" id="video-edit" method="post" enctype="multipart/form-data" files=true>  
            @method('PUT')
            @csrf      
        <div class="modal-body">
            <input type="hidden" name="id_edit">
                <div class="form-group">
                    <label>judul</label>
                    <input type="text"  name="judul_edit" class="form-control"
                        placeholder="">
                </div>
                <div class="form-group">
                    <label>link</label>
                    <input type="text"  name="link_edit" class="form-control"
                        placeholder="">
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
        $('#video-edit').on('submit', function (e) {
      e.preventDefault();
        $.ajax({
            'type': 'post',
            'url' : "{{ url('video') }}"+"/"+$('input[name=id_edit]').val(),
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