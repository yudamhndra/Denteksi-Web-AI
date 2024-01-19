@extends('layout.master')

@section('content')
<div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
    <div>
    <h4 class="mb-3 mb-md-0">Dashboard Dokter</h4>
    </div>
</div>

<div class="row">
    <div class="col-12 col-xl-12 stretch-card">
    <div class="row flex-grow-1">
        <div class="col-md-4 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
            <div class="d-flex justify-content-between align-items-baseline">
                <h6 class="card-title mb-0">Jumlah Data Orangtua</h6>

            </div>
            <div class="row">
                <div class="col-6 col-md-12 col-xl-5">
                <h3 class="mt-4">{{$orangtua}}</h3>
                <div class="d-flex align-items-baseline">
                    <p class="text-success">
                    <span></span>
                    <!-- <i data-feather="arrow-up" class="icon-sm mb-1"></i> -->
                    </p>
                </div>
                </div>
                <div class="col-6 col-md-12 col-xl-7">
                <div  class="mt-md-3 mt-xl-0"></div>
                </div>
            </div>
            </div>
        </div>
        </div>
        <div class="col-md-4 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
            <div class="d-flex justify-content-between align-items-baseline">
                <h6 class="card-title mb-0">Data Jumlah Anak</h6>
               
            </div>
            <div class="row">
                <div class="col-6 col-md-12 col-xl-5">
                <h3 class="mt-4">{{$anak}}</h3>
                <div class="d-flex align-items-baseline">
                    <p class="text-danger">
                    <span></span>
                    <!-- <i data-feather="arrow-down" class="icon-sm mb-1"></i> -->
                    </p>
                </div>
                </div>
                <div class="col-6 col-md-12 col-xl-7">
                <div  class="mt-md-3 mt-xl-0"></div>
                </div>
            </div>
            </div>
        </div>
        </div>
        <div class="col-md-4 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
            <div class="d-flex justify-content-between align-items-baseline">
                <h6 class="card-title mb-0">Jumlah Data Sekolah</h6>

            </div>
            <div class="row">
                <div class="col-6 col-md-12 col-xl-5">
                <h3 class="mb-2">{{$sekolah}}</h3>
                <div class="d-flex align-items-baseline">
                    <p class="text-success">
                    <span></span>
                    <!-- <i data-feather="arrow-up" class="icon-sm mb-1"></i> -->
                    </p>
                </div>
                </div>
                <div class="col-6 col-md-12 col-xl-7">
                <div  class="mt-md-3 mt-xl-0"></div>
                </div>
            </div>
            </div>
        </div>
        </div>
    </div>
    </div>
</div> <!-- row -->
@endsection