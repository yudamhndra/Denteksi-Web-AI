<div class="modal fade" id="modal-create" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" >Tambah Video</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
        </div>
        <form class="form-horizontal" id="video-store" method="post" enctype="multipart/form-data" files=true>  
            @csrf
        <div class="modal-body">
                <div class="form-group">
                    <label>judul</label>
                    <input type="text"  name="judul" class="form-control"
                        placeholder="">
                </div>
                <div class="form-group">
                    <label>link</label>
                    <input type="text"  name="link" class="form-control"
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
        $('#video-store').on('submit', function (e) {
            e.preventDefault();
            $.ajax({
                'type': 'POST',
                'url': "{{ route('video.store') }}",
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
    });

</script>
@endpush