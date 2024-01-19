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
            <li class="breadcrumb-item active" aria-current="page">Edit Profil</li>
        </ol>
    </nav>
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">

                <form action="{{ route('dokter.profilUpdate', $dokter -> id) }}" class="forms-horizontal" id="" method="post" enctype="multipart/form-data" files=true>
                    @csrf
                    <div class="form-group">

                        {{-- foto profil --}}

                        <div class="position-relative">
                            <figure class="overflow-hidden mb-0 d-flex justify-content-center">
                                <!-- <img src="https://via.placeholder.com/1560x370" class="rounded-top" alt="profile cover" wi> -->
                                <img src="{{ asset('dokter/header/'.$dokter->header) }}" class="rounded-top" alt="profile cover" width="1560px" height="370px" onerror="this.onerror=null;this.src='https\://via.placeholder.com/1560x370';">

                            </figure>
                            <div
                                class="d-flex justify-content-between align-items-center position-absolute top-90 w-100 px-2 px-md-4 mt-n4">
                                <div class="profil-photo">
                                    <img class="wd-100 mt-3 rounded-square" src="{{ asset('dokter/avatar/'.$dokter->avatar) }}" width="100px" height="100px" onerror="this.onerror=null;this.src='https\://via.placeholder.com/100x100';"
                                        alt="profile" onclick='<input type="file" class="form-control" id="avatar" name="avatar"
                                            value="{{ $dokter -> avatar}}">'>
                                </div>
                            </div>
                        </div>


                        {{-- Tag nama --}}
                        <div class="text-p">
                            <span class="h4 text-dark">drg. {{$dokter -> nama }}</span>
                            <br>
                            <span class="h9 text-facebook">{{ $dokter -> no_str }}</span>
                        </div>

                        {{-- form profil --}}
                        <form class="forms-sample mt-5">
                                <div class="row m-2 ">
                                            <div class="col-md-6">
                                                <label for="avatar" class="col-sm-3 col-form-label">Avatar</label>
                                                    <input type="file" class="form-control" id="avatar" name="avatar"
                                                        value="{{ $dokter -> avatar}}">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="header" class="col-sm-3 col-form-label">Header</label>
                                                    <input type="file" class="form-control" id="header" name="header"
                                                value="{{ $dokter -> header}}">
                                                </div>
                                </div>
                                <!-- <div class="mt-5"> -->

                                <!-- <div class="row m-3">
                                    <label for="avatar" class="col-sm-3 col-form-label">Avatar</label>
                                    <div class="col-sm-9">
                                        <input type="file" class="form-control" id="avatar" name="avatar"
                                            value="{{ $dokter -> avatar}}">
                                    </div>
                                </div>
                                <div class="row m-3">
                                    <label for="header" class="col-sm-3 col-form-label">Header</label>
                                    <div class="col-sm-9">
                                        <input type="file" class="form-control" id="header" name="header"
                                            value="{{ $dokter -> header}}">
                                    </div>
                                </div> -->
                                <div class="row m-2">
                                    <label for="nama" class="col-form-label">Nama</label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" id="nama" name="nama"
                                            value="{{ $dokter -> nama }}">
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
                                            autocomplete="off" value="{{ $dokter -> tempat_lahir }}" placeholder="Tempat Tanggal Lahir">
                                                </div>
                                                <div class="col-md-4">
                                                <label for="tanggallahir" class="form-label">Tanggal
                                                    Lahir</label>
                                                    <input type="date" class="form-control" id="tempattanggallahir" name="tanggal_lahir"
                                            autocomplete="off" value="{{ $dokter -> tanggal_lahir }} " placeholder="Tempat Tanggal Lahir">
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="nik" class="form-label">NIK</label>
                                                    <input type="number" class="form-control" id="nik" name="nik"
                                            placeholder="Nomor Induk Kependudukan" value="{{ $dokter -> nik }}">
                                                </div>
                                </div>
                                <div class="row m-2">
                                                <div class="col-md-4">
                                                <label for="jenis-kelamin" class="form-label">Jenis
                                        Kelamin</label>
                                        <input type="text" class="form-control" id="jeniskelamin" name="jenis_kelamin"
                                            placeholder="Jenis Kelamin" value="{{ $dokter -> jenis_kelamin}}">
                                                </div>
                                                <div class="col-md-4">
                                                <label for="nohp" class="form-label">No Hp</label>
                                                <input type="number" class="form-control" id="nohp" name="no_telp"
                                            placeholder="Nomor Handphone" value="{{ $dokter -> no_telp}}">
                                                </div>
                                                <div class="col-md-4">
                                                <label for="nostr" class="form-label">No STR</label>
                                                <input type="number" class="form-control" id="nostr" name="no_str"
                                            placeholder="No STR" value="{{ $dokter -> no_str }}">
                                                </div>
                                </div>
                                <!-- <div class="row mb-3">
                                    <label for="tempatlahir" class="col-sm-3 col-form-label">Tempat Lahir</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="tempattanggallahir" name="tempat_lahir"
                                            autocomplete="off" value="{{ $dokter -> tempat_lahir }}" placeholder="Tempat Tanggal Lahir">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="tanggallahir" class="col-sm-3 col-form-label">Tanggal
                                        Lahir</label>
                                    <div class="col-sm-9">
                                        <input type="date" class="form-control" id="tempattanggallahir" name="tanggal_lahir"
                                            autocomplete="off" value="{{ $dokter -> tanggal_lahir }} " placeholder="Tempat Tanggal Lahir">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="nik" class="col-sm-3 col-form-label">NIK</label>
                                    <div class="col-sm-9">
                                        <input type="number" class="form-control" id="nik" name="nik"
                                            placeholder="Nomor Induk Kependudukan" value="{{ $dokter -> nik }}">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="jenis-kelamin" class="col-sm-3 col-form-label">Jenis
                                        Kelamin</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="jeniskelamin" name="jenis_kelamin"
                                            placeholder="Jenis Kelamin" value="{{ $dokter -> jenis_kelamin}}">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="nohp" class="col-sm-3 col-form-label">No Hp</label>
                                    <div class="col-sm-9">
                                        <input type="number" class="form-control" id="nohp" name="no_telp"
                                            placeholder="Nomor Handphone" value="{{ $dokter -> no_telp}}">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="nostr" class="col-sm-3 col-form-label">No STR</label>
                                    <div class="col-sm-9">
                                        <input type="number" class="form-control" id="nostr" name="no_str"
                                            placeholder="No STR" value="{{ $dokter -> no_str }}">
                                    </div>
                                </div> -->
                                <div class="row m-2 mt-5">
                                    <div class="col-md-2">

                                    </div>
                                    <div class="col-md-2">

                                    </div>
                                    <div class="col-md-2">

                                    </div>
                                    <div class="col-md-2">

                                    </div>
                                    <div class="col-md-2 text-end">
                                        <button class="btn btn-outline-info float-right wd-100" href="/dokter/profil">
                                             Batal
                                        </button>
                                    </div>
                                    <div class="col-md-2 text-end">
                                        <button class="btn btn-icon-text float-right wd-100" type="submit">
                                            Simpan
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
        </div>
                </form>
    </div>
</div>

            </div>
        </div>
    </div>
</div>
@endsection
