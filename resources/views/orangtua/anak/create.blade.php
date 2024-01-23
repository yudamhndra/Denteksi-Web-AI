@extends('layout.master')

@section('content')

<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="row mt-5">
                <div class="col-md-6 mx-3 mb-3 align-self-center">
                    <h5 class="mb-3 mb-md-0 text-left">TAMBAH ANAK</h5>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('tambahanak.store') }}" class="forms-sample" id="form-anak" method="post"
                    enctype="multipart/form-data" files=true>
                    @csrf

                    <div class="row col-md-10 mb-3 mx-0">
                        <label for="exampleInputPassword1" class="form-label">Nama <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama" autocomplete="off"
                           value="{{old('nama')}}" placeholder="Nama">
                           @error('nama')
                            <div class="invalid-feedback">{{ $message }}</div>
                         @enderror
                    </div>
                    <div class="mb-3 gender">
                        <label class="col-md-12 mb-2"> Jenis Kelamin <span class="text-danger">*</span> </label>
                        <div class="form-check form-check-inline">
                            <input type="radio" class="form-check-input" value="laki-laki" name="jenis_kelamin" id="radioInline">
                            <label class="form-check-label" for="radioInline">
                                Laki-Laki
                            </label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input type="radio" value="perempuan" class="form-check-input" name="jenis_kelamin" id="radioInline1">
                            <label class="form-check-label" for="radioInline1">
                                Perempuan
                            </label>
                        </div>
                        <div class="error-placement"></div> <!-- Menambahkan elemen div untuk menampilkan pesan error -->
                    </div>

                    <div class="row col-md-12">
                        <div class="col-md-5">
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Tanggal Lahir <span class="text-danger">*</span></label>
                                <input type="date" class="form-control @error('tanggal_lahir') is-invalid @enderror" id="tanggal_lahir" name="tanggal_lahir"
                                    autocomplete="off" placeholder="Masukkan tanggal lahir" value="{{old('tanggal_lahir')}}" max="{{ date('Y-m-d') }}">
                                    @error('tanggal_lahir')
                                   <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Nomor Whatsapp <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('no_whatsapp') is-invalid @enderror" id="no_whatsapp" name="no_whatsapp"
                                    autocomplete="off" placeholder="+62" value="{{old('no_whatsapps')}}" required>
                                    @error('no_whatsapp')
                                   <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                

                    <!-- Upload image -->
                    <div class="row mt-3">
                        <h5 class="mb-3 mb-md-0 text-left">TAMBAH FOTO</h5>
                    </div>

                    <div class="row">
                        <div class="col-md-8 mt-5 mx-auto">
                            <div class="card text-center custom-card shadow py-2">
                                <div class="card-body">
                                    <div class="row mt-3">
                                        <h6 class="mb-3 mb-md-0 text-left">PREVIEW</h6>
                                    </div>
                                    <img id="gigi-depan" src="{{ asset('assets/images/take-a-pict.png') }}" class="img-fluid mt-3" style="width: 400px; height: 200px;" alt="image_cloud">
                                    <div class="row px-6 mt-3">
                                        <button class="btn-create btn btn-submit-col" id="btn-use-camera"> GUNAKAN KAMERA
                                            <input type="file" name="gambar1" class="form-control" accept="image/*" id="file-input-camera" onchange="readURL(this, 'gigi-depan');">
                                        </button>
                                        <p class="col mt-1">atau</p>
                                        <button class="btn btn-submit-white mt-1" id="btn-ambil-dari-galeri"><i class="far fa-image" style="margin-right: 10px;"></i> AMBIL DARI GALERI</button>
                                    </div>
                                </div>
                            </div>
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

    function ambilDariGaleri() {
        // Membuat input file
        var inputFile = document.createElement('input');
        inputFile.type = 'file';
        inputFile.accept = 'image/*';
        inputFile.style.display = 'none';

        // Menambahkan event listener untuk perubahan input file
        inputFile.addEventListener('change', function (event) {
            var file = event.target.files[0];

            // Membaca file gambar menggunakan FileReader
            var reader = new FileReader();
            reader.onload = function (e) {
                // Menampilkan pratinjau gambar
                $('#gigi-depan').attr('src', e.target.result);
            };
            reader.readAsDataURL(file);
        });

        // Menambahkan input file ke dalam dokumen dan memicu klik
        document.body.appendChild(inputFile);
        inputFile.click();

        // Menghapus input file setelah digunakan
        document.body.removeChild(inputFile);
    }

    $(document).ready(function () {
        $('#tempat_lahir,#nama').on('input', function () {
            var currentVal = $(this).val();
            var capitalizedVal = capitalizeAfterSpace(currentVal);
            $(this).val(capitalizedVal);
        });

        function capitalizeAfterSpace(str) {
            var words = str.split(' ');
            for (var i = 0; i < words.length; i++) {
                if (words[i].length > 0) {
                    words[i] = words[i].charAt(0).toUpperCase() + words[i].slice(1).toLowerCase();
                }
            }
            return words.join(' ');
        }

        $("#form-anak").validate({
            rules: {
                nama: "required",
                tempat_lahir:"required",
                tanggal_lahir:"required",
                jenis_kelamin:"required",
            },
            messages: {
                nama: "Nama wajib diisi",
                tempat_lahir: "Tempat lahir wajib diisi",
                tanggal_lahir: "Tanggal lahir wajib diisi",
                jenis_kelamin: "Jenis kelamin wajib diisi",
            },
            errorPlacement: function(error, element) {
                if (element.attr("name") == "jenis_kelamin") {
                    error.appendTo(element.parents('.gender').find('.error-placement'));
                } else {
                    error.insertAfter(element);
                }
            },
            submitHandler: function(form) {
                form.submit();
            }
        });

        // Memanggil fungsi ambilDariGaleri saat tombol "AMBIL DARI GALERI" diklik
        $('#btn-ambil-dari-galeri').on('click', function () {
            ambilDariGaleri();
        });

    });

    $(document).ready(function() {
        $('#btn-cancel').on('click', function() {
            window.history.back();
        });
    });

    // Session camera
    var useCameraButton = document.getElementById('btn-use-camera');
    useCameraButton.addEventListener('click', function () {
        requestCameraPermission();
    });

    function requestCameraPermission() {
        navigator.mediaDevices.getUserMedia({ video: true })
            .then(function (stream) {
                var videoElement = document.createElement('video');
                videoElement.srcObject = stream;
                videoElement.autoplay = true;
                videoElement.style.width = '100%';

                var modalContent = document.createElement('div');
                modalContent.appendChild(videoElement);

                $('#cameraModal').modal('show');
                $('#cameraModal .modal-body').html(modalContent);

                $('#cameraModal').on('hidden.bs.modal', function () {
                    stream.getTracks().forEach(function (track) {
                        track.stop();
                    });
                });
            })
            .catch(function (error) {
                console.error('Error accessing camera: ', error);
                alert('Izin kamera diperlukan untuk menggunakan fitur ini.');
            });
    }

</script>

@endpush
