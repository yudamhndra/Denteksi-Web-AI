@extends('layout.master')
@section('content')

<div class="card shadow p-3">
    <div class="card-body">
        <form method="POST" action="{{ route('pemeriksaangigi.store') }}" enctype="multipart/form-data">
            <!-- <div class="row">
                <div class="col-md-6 align-self-center">
                    <h5 class="mb-3 mb-md-0 text-left">WILAYAH PEMERIKSAAN </h5>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="kecamatan">Kecamatan</label>
                        <select class="form-control mt-2" id="kecamatan"> -->
                            <!-- Ubah Nanti -->
                            <!-- <option value="kecamatan1">Kecamatan 1</option>
                            <option value="kecamatan2">Kecamatan 2</option>
                            <option value="kecamatan3">Kecamatan 3</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="kelurahan">Kelurahan</label>
                        <select class="form-control mt-2" id="kelurahan"> -->
                            <!-- Ubah Nanti -->
                            <!-- <option value="kelurahan1">Kelurahan 1</option>
                            <option value="kelurahan2">Kelurahan 2</option>
                            <option value="kelurahan3">Kelurahan 3</option>

                        </select>
                    </div>
                </div>
            </div> -->

            <div class="row mt-5">
                <div class="col-md-6 align-self-center">
                    <h5 class="mb-3 mb-md-0 text-left">UNGGAH FOTO</h5>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4 mt-5 px-xl-5">
                    <div class="card text-center custom-card shadow w-100 py-2">
                        <div class="card-body">
                            <img id="gigi-depan" src="{{ asset('assets/images/upload-foto.png') }}" class="img-fluid" style="width: 200px; height: 200px;" alt="image_cloud">
                            <input type="file" class="form-control" accept="image/*" id="file-input" onchange="readURL(this, 'gigi-depan');" required>
                        </div>
                    </div>
                    <p class="text-center p-4">Gigi Depan</p>
                </div>

                <div class="col-md-4 mt-5 px-xl-5">
                    <div class="card text-center custom-card shadow w-100 py-2">
                        <div class="card-body">
                            <img id="gigi-atas" src="{{ asset('assets/images/upload-foto.png') }}" class="img-fluid" style="width: 200px; height: 200px;" alt="image_cloud">
                            <input type="file" class="form-control" accept="image/*" id="file-input" onchange="readURL(this, 'gigi-atas');" required>
                        </div>
                    </div>
                    <p class="text-center p-4">Gigi Atas</p>
                </div>

                <div class="col-md-4 mt-5 px-xl-5">
                    <div class="card text-center custom-card shadow w-100 py-2">
                        <div class="card-body">
                            <img id="gigi-bawah" src="{{ asset('assets/images/upload-foto.png') }}" class="img-fluid" style="width: 200px; height: 200px;" alt="image_cloud">
                            <input type="file" class="form-control" accept="image/*" id="file-input" onchange="readURL(this, 'gigi-bawah');" required>
                        </div>
                    </div>
                    <p class="text-center p-4">Gigi Bawah</p>
                </div>
            </div>

            <div class="d-flex justify-content-end mt-5">
                <button type="button" class="btn btn-cancel wd-100 mt-3 button ml-auto" id="btn-cancel">
                    Batal
                </button>
                    <form id="periksaForm" action="{{ route('periksa-gigi.store') }}" method="POST">
                    @csrf
                    <button type="button" class="btn btn-primary wd-150 mt-3 button ml-2" style="margin-left: 10px;" id="btn-periksa">
                        Periksa Sekarang
                    </button>
                </form>
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

    document.getElementById('btn-periksa').addEventListener('click', function() {
        window.location.href = "{{ route('periksa-gigi.store') }}";
    });
    });
</script>
@endpush
