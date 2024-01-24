@extends('layout.master')
@section('content')

<div class="card shadow p-3">
    <div class="card-body">
        <form method="POST" action="{{ route('pemeriksaangigi.store') }}" enctype="multipart/form-data" id="pisik-store" files=true>
            @csrf

            <div class="row mt-5">
                <div class="col-md-6 align-self-center">
                    <h5 class="mb-3 mb-md-0 text-left">METODE PERIKSA</h5>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4 mt-5 mx-auto">
                    <div class="card text-center custom-card shadow w-100 py-2">
                        <div class="card-body">
                            <video id="camera-preview" class="img-fluid mt-3" style="width: 200px; height: 200px;" autoplay playsinline></video>
                            <button type="button" class="btn btn-secondary mt-2" id="btn-switch-camera">
                                Switch Kamera
                            </button>
                            <button type="button" class="btn btn-secondary mt-2" id="btn-take-picture">
                                Snapshoot
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-5">
                <div class="col-md-6 align-self-center">
                    <h5 class="mb-3 mb-md-0 text-left">HASIL PERIKSA</h5>
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
                </div>
            </div>

            <div class="d-flex justify-content-end mt-5">
                <div>
                    <button type="button" class="btn btn-cancel wd-100 mt-3 button" id="btn-cancel">
                        Batal
                    </button>
                    <button type="submit" class="btn btn-primary wd-150 mt-3 button ml-2" style="margin-left: 10px;" id="btn-periksa">
                        Periksa Sekarang
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>  

@push('after-script')
<script type="text/javascript">
    var videoElement = document.getElementById('camera-preview');
    var switchCameraButton = document.getElementById('btn-switch-camera');
    var takePictureButton = document.getElementById('btn-take-picture');
    var fileInput = document.getElementById('file-input');
    var toggleMethodButton = document.getElementById('btn-toggle-method');
    var uploadCard = document.getElementById('upload-card');
    var cameraSection = document.getElementById('camera-section');
    var cameraPreviewSection = document.getElementById('camera-preview-section');

    var currentStream;
    var currentCameraIndex = 0;

    function requestCameraAccess() {
        navigator.mediaDevices.getUserMedia({ video: true })
            .then(function (stream) {
                videoElement.srcObject = stream;
            })
            .catch(function (error) {
                console.error('Error accessing camera: ', error);
            });
    }

    navigator.mediaDevices.enumerateDevices()
        .then(function (devices) {
            var videoDevices = devices.filter(function (device) {
                return device.kind === 'videoinput';
            });

            var cameraOptions = videoDevices.map(function (device, index) {
                return { deviceId: device.deviceId, label: 'Camera ' + (index + 1) };
            });

            switchCameraButton.addEventListener('click', function () {
                switchCamera();
            });

            takePictureButton.addEventListener('click', function () {
                takePicture();
            });

            toggleMethodButton.addEventListener('click', function () {
                toggleMethod();
            });

            // Panggil fungsi untuk memulai kamera
            startCamera(cameraOptions[0].deviceId);
        })
        .catch(function (error) {
            console.error('Error enumerating devices: ', error);
        });

    function switchCamera() {
        if (currentStream) {
            currentStream.getTracks().forEach(function (track) {
                track.stop();
            });
        }

        var cameraOptions = getCameraOptions();
        currentCameraIndex = (currentCameraIndex + 1) % cameraOptions.length;
        startCamera(cameraOptions[currentCameraIndex].deviceId);
    }

    function takePicture() {
        if (currentStream) {
            var canvas = document.createElement('canvas');
            canvas.width = videoElement.videoWidth;
            canvas.height = videoElement.videoHeight;
            var context = canvas.getContext('2d');
            context.drawImage(videoElement, 0, 0, canvas.width, canvas.height);

            canvas.toBlob(function (blob) {
                // Append the image blob to the form data
                var formData = new FormData(document.getElementById('pisik-store'));
                formData.append('gambar1', blob, 'image.png'); // 'gambar1' should match your form field name

                // Update the card for uploading a photo
                updateUploadCard(blob);

                // If you need to send the formData using Ajax, you can do something like this:
                $.ajax({
                    url: "{{ route('pemeriksaangigi.store') }}",
                    method: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (response) {
                        console.log(response);
                    },
                    error: function (error) {
                        console.error('Error uploading image: ', error);
                    }
                });
            }, 'image/png');
        }
    }

    function toggleMethod() {
        // Toggle between camera preview and upload photo sections
        if (cameraSection.style.display === 'block') {
            cameraSection.style.display = 'none';
            cameraPreviewSection.style.display = 'block';
        } else {
            cameraSection.style.display = 'block';
            cameraPreviewSection.style.display = 'none';
        }
    }

    function updateUploadCard(blob) {
        // Create a new FileReader to read the Blob as Data URL
        var reader = new FileReader();

        reader.onloadend = function () {
            // Use Data URL to display the image on the card
            $('#gigi-depan').attr('src', reader.result);
        };

        reader.readAsDataURL(blob);
    }

    function startCamera(deviceId) {
        var constraints = {
            video: { deviceId: { exact: deviceId } }
        };

        navigator.mediaDevices.getUserMedia(constraints)
            .then(function (stream) {
                videoElement.srcObject = stream;
                currentStream = stream;

                // Show the camera preview section and hide the upload photo section
                cameraSection.style.display = 'none';
                cameraPreviewSection.style.display = 'block';
                uploadCard.style.display = 'none';
            })
            .catch(function (error) {
                console.error('Error starting camera: ', error);
            });
    }

    function getCameraOptions() {
        return navigator.mediaDevices.enumerateDevices()
            .then(function (devices) {
                return devices.filter(function (device) {
                    return device.kind === 'videoinput';
                }).map(function (device) {
                    return { deviceId: device.deviceId, label: device.label || 'Camera' };
                });
            })
            .catch(function (error) {
                console.error('Error getting camera options: ', error);
                return [];
            });
    }

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
        requestCameraAccess();

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


@endsection
