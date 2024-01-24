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
                <form action="{{route('orangtua.updateprofil')}}" class="forms-horizontal"  method="post" enctype="multipart/form-data" files=true>
                    @csrf
                    <div class="form-group">
                        <div class="mt-5">
                            <form class="forms-sample mt-5">
                            <div class="row mb-3">
                                    <label for="email" class="col-sm-3 col-form-label">Email</label>
                                    <div class="col-sm-9">
                                        <input type="email" class="form-control" id="email"
                                            placeholder="Email" value="{{ Auth::user() -> email }}" readonly>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="nama" class="col-sm-3 col-form-label">Nama</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="nama" id="nama"
                                            value="{{ $user->profildokter -> nama ?? " "}}" >
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="tempatlahir" class="col-sm-3 col-form-label">Tempat Lahir</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="tempat_lahir"
                                            autocomplete="off" value="{{ $user->profildokter -> tempat_lahir ?? " " }}" placeholder="Tempat Tanggal Lahir">
                                    </div>
                               </div>
                                <div class="row mb-3">
                                    <label for="tanggallahir" class="col-sm-3 col-form-label">Tanggal
                                        Lahir</label>
                                    <div class="col-sm-9">
                                        <input type="date" class="form-control" name="tanggal_lahir" id="tanggal_lahir"
                                            autocomplete="off"  placeholder="Tempat Tanggal Lahir" value="{{$user->profildokter->tanggal_lahir ?? " "}}" >
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="nik" class="col-sm-3 col-form-label">Pendidikan</label>
                                    <div class="col-sm-9">
                                        <select class="form-select" name="pendidikan" id="pendidikan" data-width="100%" required>
                                            <option selected disabled>Pilih Pendidikan</option>
                                            <option value="SD" {{ optional($user->profildokter)->pendidikan=="SD" ? 'selected' : ''}}>SD</option>
                                            <option value="SMP"{{ optional($user->profildokter)->pendidikan=="SMP" ? 'selected' : ''}}>SMP</option>
                                            <option value="SMA"{{ optional($user->profildokter)->pendidikan=="SMA" ? 'selected' : ''}}>SMA/SMK</option>
                                            <option value="D1" {{ optional($user->profildokter)->pendidikan=="D1" ? 'selected' : ''}}>D1</option>
                                            <option value="D2" {{ optional($user->profildokter)->pendidikan=="D2" ? 'selected' : ''}}>D2</option>
                                            <option value="D3" {{ optional($user->profildokter)->pendidikan=="D3" ? 'selected' : ''}}>D3</option>
                                            <option value="D4" {{ optional($user->profildokter)->pendidikan=="D4" ? 'selected' : ''}}>D4</option>
                                            <option value="S1" {{ optional($user->profildokter)->pendidikan=="S1" ? 'selected' : ''}}>S1</option>
                                            <option value="S2" {{ optional($user->profildokter)->pendidikan=="S2" ? 'selected' : ''}}>S2</option>
                                            <option value="S3" {{ optional($user->profildokter)->pendidikan=="S3" ? 'selected' : ''}}>S3</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="alamat" class="col-sm-3 col-form-label">Alamat
                                        </label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control"  name="alamat"
                                            placeholder="alamat" value="{{ $user->profildokter ->alamat ?? " "}}" >
                                    </div>
                                </div>




                                <div class="row mb-3">
                                    <label for="tempatlahir" class="col-sm-3 col-form-label">Foto Gigi</label>
                                    <div class="col-sm-9">
                                        @if($user->profildokter)
                                            <input type="file"  class="form-control dropify" name="foto" placeholder="masukkan gambar" data-default-file="{{url ('storage/orangtua/'.$user->profildokter ->foto) ?? ''}}">
                                        @else
                                            <input type="file"  class="form-control dropify" name="foto" placeholder="masukkan gambar" >
                                        @endif

                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="row">
                            <div class="col-sm-3"></div>
                            <div class="col-sm-9">
                        <button type="submit" class="btn btn-primary me-2">Submit</button>
                    <a href="{{URL::previous()}}" type="button" class="btn btn-secondary">Cancel</a>
                    </div>
                    </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
@endsection
@push('after-script')
<script type="text/javascript">
$(document).ready(function () {
        $('.dropify').dropify({
    messages: {
        'default': 'Drag and drop a file here or click',
        'replace': 'Drag and drop or click to replace',
        'remove':  'Hapus',
        'error':   'Ooops, something wrong happended.'
    }
});
});
</script>
@endpush
