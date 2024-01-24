@extends('layout.master')

@section('navbar-title')
Anak
@endsection
@section('content')

<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h6 class="text-center h3">Edit Anak</h6>
                <form action="{{ route('anak.update',$pasien->id) }}" class="forms-sample" id="dokter-update" method="post" nctype="multipart/form-data" files=true >
                    <input type="hidden" id="id" value="{{$pasien->id}}">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label class="form-label">Nama Orangtua <span class="text-danger">*</span></label>
                        <select class="js-example-basic-single form-select" name="orangtua" data-width="100%">
                            @foreach(\App\Models\Dokter::get() as $value => $key)
                      
                            <option value="{{$key->id}}">{{$key->nama}}</option>
                        @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Nama <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="nama" name="nama" autocomplete="off" value="{{$pasien->nama}}"
                            placeholder="Masukkan Nama">
                            @error('nama')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="col-md-12 mb-2"> Jenis Kelamin <span class="text-danger">*</span> </label>
                        <div class="form-check form-check-inline">
                            <input type="radio" class="form-check-input" value="laki-laki" name="jenis_kelamin"
                                id="radioInline" {{ ($pasien->jenis_kelamin=="laki-laki")? "checked" : "" }}>
                            <label class="form-check-label" for="radioInline">
                                Laki-Laki
                            </label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input type="radio" value="perempuan" class="form-check-input" name="jenis_kelamin"
                                id="radioInline1"  {{ ($pasien->jenis_kelamin=="perempuan")? "checked" : "" }}>
                            <label class="form-check-label" for="radioInline1">
                                Perempuan
                            </label>
                        </div>
                        @error('jenis_kelamin')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                    </div>
                    <div class="row col-md-10">
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Tempat
                                    Lahir <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir"
                                    autocomplete="off" placeholder="Tempat Lahir" value="{{$pasien->tempat_lahir}}">
                                    @error('tempat_lahir')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-7">
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Tanggal
                                    Lahir <span class="text-danger">*</span></label>
                                <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir"
                                    autocomplete="off" placeholder="masukkan tanggal lahir" value="{{ \Carbon\Carbon::parse($pasien->tanggal_lahir)->format('Y-m-d') }}">
                                    @error('tanggal_lahir')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                  
                    <div style="float: right">
                    <button type="submit" class="btn btn-primary me-2">Ubah</button>
                    <a href="{{URL::previous()}}" type="button" class="btn btn-secondary">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

