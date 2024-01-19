@extends('layout.master')

@section('content')
<div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
    <div>
    <h2 class="mb-3 mb-md-0">Selamat Datang</h2>
    @foreach (Auth::user()->dokter as $dokter)
    <h2 class="mb-3 mb-md-0">drg. {{$dokter -> nama }}</h2>
    @endforeach
    <!-- <h2 class="mb-3 mb-md-0">{{ isset($user->nama) ? $user->nama : 'Dokter' }}</h2> -->
    </div>
</div>

<div class="card shadow px-3 py-1">
    <div class="card-body">
        <div class="row">
            <div class="col-md-6 align-self-center">
                <h2 class="mb-3 mb-md-0 text-left">Periksa dengan </h2>
                <h2 class="mb-3 mb-md-0 text-left">Scan QR</h2>
                <a type="button" href="#scan-camera" class="btn btn-primary px-6 mt-3 button">SCAN SEKARANG</a>
            </div>
            <div class="col-md-6 text-center">
                <img class="wd-250 ht-250" src="{{asset('assets/images/image-scanqr.png')}}" alt="Senyumin" class="img-fluid">
            </div>
        </div>
    </div>
</div>

<div class="col-md-6 grid-margin stretch-card mt-6">
        <div class="card data-siswa shadow px-3 py-1">
            <div class="card-body">
            <div class="row">
                <div class="col text-center">
                <h2>{{$anak}}</h2>
                <div class="d-flex align-items-baseline">
                    <p class="text-success">
                    <span></span>
                    <!-- <i data-feather="arrow-up" class="icon-sm mb-1"></i> -->
                    </p>
                </div>
                </div>
            </div>
            <div class="d-flex justify-content-center align-items-baseline">
                <h6 class="card-title mb-0 text-center">Total Data Siswa</h6>
                <!-- <div class="dropdown mb-2">
                <button class="btn p-0" type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="icon-lg text-muted pb-3px" data-feather="more-horizontal"></i>
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
                    <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="eye" class="icon-sm me-2"></i> <span class="">View</span></a>
                    <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="edit-2" class="icon-sm me-2"></i> <span class="">Edit</span></a>
                    <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="trash" class="icon-sm me-2"></i> <span class="">Delete</span></a>
                    <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="printer" class="icon-sm me-2"></i> <span class="">Print</span></a>
                    <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="download" class="icon-sm me-2"></i> <span class="">Download</span></a>
                </div>
                </div> -->
            </div>
            </div>
        </div>
        </div>

<div class="col-12 col-xl-12 stretch-card mt-4">
    <div class="row flex-grow-1">
        <div class="col-md-6 grid-margin stretch-card ">
        <div class="card shadow px-3 py-1">
            <div class="card-body">
            <div class="d-flex justify-content-between align-items-baseline">
                <h6 class="card-title mb-0">Data Skrining UKGS</h6>
                <div class="dropdown mb-2">
                <button class="btn p-0" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="icon-lg text-muted pb-3px" data-feather="more-horizontal"></i>
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="eye" class="icon-sm me-2"></i> <span class="">View</span></a>
                    <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="edit-2" class="icon-sm me-2"></i> <span class="">Edit</span></a>
                    <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="trash" class="icon-sm me-2"></i> <span class="">Delete</span></a>
                    <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="printer" class="icon-sm me-2"></i> <span class="">Print</span></a>
                    <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="download" class="icon-sm me-2"></i> <span class="">Download</span></a>
                </div>
                </div>
            </div>
            <div class="row">
                <div class="col-6 col-md-12 col-xl-5">
                <h3 class="mb-2">{{$totalukgs}}</h3>
                <div class="d-flex align-items-baseline">
                    <p class="text-success">
                    <span></span>
                    <!-- <i data-feather="arrow-up" class="icon-sm mb-1"></i> -->
                    </p>
                </div>
                </div>
                <div class="col-6 col-md-12 col-xl-7">
                <div id="customersChart" class="mt-md-3 mt-xl-0"></div>
                </div>
            </div>
            </div>
        </div>
        </div>
        <div class="col-md-6 grid-margin stretch-card">
        <div class="card shadow px-3 py-1">
            <div class="card-body">
            <div class="d-flex justify-content-between align-items-baseline">
                <h6 class="card-title mb-0">Data Skrining UKGM</h6>
                <div class="dropdown mb-2">
                <button class="btn p-0" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="icon-lg text-muted pb-3px" data-feather="more-horizontal"></i>
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                    <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="eye" class="icon-sm me-2"></i> <span class="">View</span></a>
                    <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="edit-2" class="icon-sm me-2"></i> <span class="">Edit</span></a>
                    <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="trash" class="icon-sm me-2"></i> <span class="">Delete</span></a>
                    <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="printer" class="icon-sm me-2"></i> <span class="">Print</span></a>
                    <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="download" class="icon-sm me-2"></i> <span class="">Download</span></a>
                </div>
                </div>
            </div>
            <div class="row">
                <div class="col-6 col-md-12 col-xl-5">
                <h3 class="mb-2">{{$totalukgm}}</h3>
                <div class="d-flex align-items-baseline">
                    <p class="text-danger">
                    <span></span>
                    <!-- <i data-feather="arrow-down" class="icon-sm mb-1"></i> -->
                    </p>
                </div>
                </div>
                <div class="col-6 col-md-12 col-xl-7">
                <div id="ordersChart" class="mt-md-3 mt-xl-0"></div>
                </div>
            </div>
            </div>
        </div>
        </div>
    </div>
    </div>


    <div class="col-12 col-xl-12 mb-5">
        <div class="card shadow px-3 py-1" id="scan-camera">
            <div class="card-body p-6">
                <div class="text-center mb-4 row">
                    <h3>PERIKSA DENGAN SCAN QR</h3>
                </div>
                <div id="reader" width="200px" height="200px">
                    <!-- ... (Scan QR content) ... -->
                </div>
                <div class="input-group mt-4">
                    <input type="text" id="text_scan_input" class="form-control" placeholder="your link here" readonly/>
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary" type="button" onclick="browse_url()">Browse</button>
                    </div>
                </div>
            </div>
        </div>
    </div>



<script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>
<script>
var url_code;

function onScanSuccess(decodedText, decodedResult) {
  console.log(`Code matched = ${decodedText}`, decodedResult);
  document.getElementById("text_scan_input").value = decodedText;
  url_code = decodedText;
  window.open(url_code, "_self")
//   window.open(decodedText, "_self")
}

function browse_url(){
      window.open(url_code, "_self")
}

function onScanFailure(error) {
}

let html5QrcodeScanner = new Html5QrcodeScanner(
  "reader",
  { fps: 10, qrbox: {width: 300, height: 300} },
  /* verbose= */ false);
html5QrcodeScanner.render(onScanSuccess, onScanFailure);

</script>

@endsection


