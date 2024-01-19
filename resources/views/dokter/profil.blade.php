@extends('layout.master')

@section('content')
<style>
    profile-photo .img {
        position: absolute;
        width: 111.34px;
        height: 100px;
        left: 24px;
        top: 179px;

    }

    .text-p {
        position: relative;
        padding: 5px;
        left: 130px;
    }

</style>
<div class="container-fluid">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">Profil</li>
        </ol>
    </nav>
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                @foreach (Auth::user()->dokter as $dokter)
                <form action="{{route('dokter.profilEdit', $dokter->id)}}" class="forms-horizontal" id="profil" method="post" nctype="multipart/form-data" files=true>
                    @csrf
                    <div class="form-group">

                        {{-- foto profil --}}
                        <div class="position-relative">
                            <figure class="overflow-hidden mb-0 d-flex justify-content-center">
                                <!-- <img src="https://via.placeholder.com/1560x370" class="rounded-top" alt="profile cover" wi> -->
                                <img src="{{ asset('dokter/header/'.$dokter->header) }}" class="rounded-top" alt="profile cover" width="1560px" height="370px" onerror="this.onerror=null;this.src='https\://via.placeholder.com/1560x370';">
                            </figure>
                            <div
                                class="d-flex justify-content-center align-items-center position-absolute top-90 w-100 px-2 px-md-4 mt-n4">
                                <div class="profil-photo">
                                    <img class="wd-100 mt-3  rounded-circle" src="{{ asset('dokter/avatar/'.$dokter->avatar) }}"
                                        alt="profile" width="100px" height="100px" onerror="this.onerror=null;this.src='https\://via.placeholder.com/100x100';">
                                </div>

                            </div>
                        </div>

                        {{-- Tag nama --}}
                        <div class="text-center pt-5 mt-5">
                            <span class="h4 text-dark">drg. {{$dokter -> nama }}</span>
                            <br>
                            <span class="h9 text-facebook">{{ $dokter -> no_str }}</span>
                        </div>

                        <div style="float: right">
                            <button class="btn btn-icon-text " type="submit">
                                <i data-feather="edit" class="btn-icon-prepend"></i> Edit Profil
                            </button>
                        </div>

                        {{-- form profil --}}

                    <div class="mt-5 mb-5">
                        <form class="forms-sample mt-5">
                                <div class="row m-2">
                                    <label for="nama" class="col-form-label">Nama</label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" id="nama" name="nama"
                                            value="{{ $dokter -> nama }}" readonly>
                                    </div>
                                </div>
                                <div class="row m-2 mb-3">
                                    <label for="email" class="col-form-label">Email</label>
                                    <div class="col-sm-12">
                                        <input type="email" class="form-control" id="email" name="email"
                                            placeholder="Email" value="{{ Auth::user() -> email }}" readonly>
                                    </div>
                                </div>

                                <div class="row m-2 mb-3">
                                                <div class="col-md-4">
                                                <label for="tempatlahir" class="form-label">Tempat Lahir</label>
                                                <input type="text" class="form-control" id="tempattanggallahir" name="tempat_lahir"
                                            autocomplete="off" value="{{ $dokter -> tempat_lahir }}" placeholder="Tempat Tanggal Lahir" readonly>
                                                </div>
                                                <div class="col-md-4">
                                                <label for="tanggallahir" class="form-label">Tanggal
                                                    Lahir</label>
                                                    <input type="text" class="form-control" id="tempattanggallahir" readonly
                                            autocomplete="off" value="{{ $dokter -> tanggal_lahir }} " placeholder="Tempat Tanggal Lahir">
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="nik" class="form-label">NIK</label>
                                                    <input type="number" class="form-control" id="nik" name="nik"
                                            placeholder="Nomor Induk Kependudukan" value="{{ $dokter -> nik }}" readonly>
                                                </div>
                                </div>
                                <div class="row m-2">
                                                <div class="col-md-4">
                                                <label for="jenis-kelamin" class="form-label">Jenis
                                        Kelamin</label>
                                        <input type="text" class="form-control" id="jeniskelamin" name="jenis_kelamin"
                                            placeholder="Jenis Kelamin" value="{{ $dokter -> jenis_kelamin}}" readonly>
                                                </div>
                                                <div class="col-md-4">
                                                <label for="nohp" class="form-label">No Hp</label>
                                                <input type="number" class="form-control" id="nohp" name="no_telp"
                                            placeholder="Nomor Handphone" value="{{ $dokter -> no_telp}}" readonly>
                                                </div>
                                                <div class="col-md-4">
                                                <label for="nostr" class="form-label">No STR</label>
                                                <input type="number" class="form-control" id="nostr" name="no_str"
                                            placeholder="No STR" value="{{ $dokter -> no_str }}" readonly>
                                                </div>
                                </div>
                        </form>
                    </div>
                @endforeach
        </div>
    </div>
</div>
        </div>
    </div>
@endsection
