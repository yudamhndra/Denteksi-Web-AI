@extends('layout.master')
@section('content')

<div class="card shadow p-3">
    <div class="card-body">
        <form method="POST" action="{{ route('pemeriksaangigi.store') }}" enctype="multipart/form-data" id="pisik-store" files=true>
            @csrf
            
            <div class="row mt-5">
                <div class="col-md-6 align-self-center">
                    <h5 class="mb-3 mb-md-0 text-left">UNGGAH FOTO</h5>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4 mt-5 mx-auto">
                    <div class="card text-center custom-card shadow w-100 py-2">
                        <div class="card-body">
                            <img id="gigi-depan" src="{{ asset('assets/images/upload-foto.png') }}" class="img-fluid" style="width: 200px; height: 200px;" alt="image_cloud">
                            <input type="file" name="gambar1" class="form-control" accept="image/*" id="file-input" onchange="readURL(this, 'gigi-depan');" required>
                        </div>
                    </div>
                    <!-- <p class="text-center p-4">Gigi Depan</p> -->
                </div>
            </div> 

            <div class="d-flex justify-content-end mt-5">
                <button type="button" class="btn btn-cancel wd-100 mt-3 button ml-auto" id="btn-cancel">
                    Batal
                </button>
                <button type="submit" class="btn btn-primary wd-150 mt-3 button ml-2" style="margin-left: 10px;" id="btn-periksa">
                    Periksa Sekarang
                </button>
            </div>
        </form>
    </div>
</div>  
@endsection

@push('after-script')
<script type="text/javascript">
    function readURL(input, imageId) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#' + imageId).attr('src', e.target.result);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

    $(document).ready(function () {
        $("#btn-cancel").on("click", function () {
            window.history.back();
        });

        $("#btn-periksa").on("click", function () {
            $("#periksaForm").submit();
        });

        $("#periksaForm").submit(function (event) {
            window.history.back();
            event.preventDefault(); 
        });

    });
</script>
@endpush
