@extends('layout.master')
@section('navbar-title')
Orangtua
@endsection
@section('content')

<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h6 class="text-center h3">Ubah Dokter</h6>
                <form action="{{ route('orangtua.update', $dokter->id) }}" class="forms-sample" id="orangtua-store"
                    method="post" nctype="multipart/form-data" files=true>
                    <input type="hidden" id="id" value="{{$dokter->id}}">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Email <span class="text-danger">*</span></label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Email"
                            value="{{$dokter->user->email}}" readonly>
                            @error('email')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <div class="form-check form-switch mb-2">
                            <input type="checkbox" class="form-check-input" id="chk" type="reset" value="Reset">
                            <label class="form-check-label" id="labelchk" for="formSwitch1">Tidak mengubah
                                Password</label>
                        </div>
                    </div>
                    <div id="ubah_password">

                    </div>

                    <!-- <div class="form-check mb-2" id="show_password">
                            <input type="checkbox" class="form-check-input" id="exampleCheck1">
                            <label class="form-check-label" for="exampleCheck1">
                                Show Password
                            </label>
                        </div> -->


                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Nama <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="nama" name="nama" autocomplete="off"
                            placeholder="Nama" value="{{$dokter->nama}}">
                            @error('nama')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="row col-md-10">
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Tempat
                                    Lahir <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir"
                                    autocomplete="off" placeholder="Tempat Lahir" value="{{$dokter->tempat_lahir}}">
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
                                    autocomplete="off" placeholder="masukkan tanggal lahir" value="{{$dokter->tanggal_lahir}}">
                                    @error('tanggal_lahir')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Kecamatan <span class="text-danger">*</span></label>
                        <select class="form-select" name="id_kecamatan" id="id_kecamatan" data-width="100%">
                            <option class="mb-2" value=" ">---Pilih Kecamatan---</option>
                            @foreach(\App\Models\Kecamatan::orderBy('nama','asc')->get() as
                            $value => $key)

                            <option value="{{$key->id}}" {{$key->id == $dokter->id_kecamatan ? 'selected' : ''}}>
                                {{$key->nama}}</option>
                            @endforeach
                        </select>
                        @error('id_kecamatan')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Kelurahan <span class="text-danger">*</span></label>
                        <select class="form-select" name="id_kelurahan" id="kelurahan" data-width="100%">
                            <option class="mb-2" value=" ">---Pilih Kelurahan---</option>
                            @foreach(\App\Models\Kelurahan::orderBy('nama','asc')->get() as
                            $value => $key)

                            <option value="{{$key->id}}" {{$key->id == $dokter->id_kelurahan ? 'selected' : ''}}>
                                {{$key->nama}}</option>
                            @endforeach
                        </select>
                        @error('id_kelurahan')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                    </div>

                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Alamat <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="alamat" name="alamat" autocomplete="off"
                            placeholder="alamat" value="{{$dokter->alamat}}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Pendidikan <span class="text-danger">*</span></label>
                        <select class="form-select" name="pendidikan" id="pendidikan" data-width="100%" required>
                            <option selected disabled>Pilih Pendidikan</option>
                            <option value="SD" {{$dokter->pendidikan=="SD" ? 'selected' : ''}}>SD</option>
                            <option value="SMP" {{$dokter->pendidikan=="SMP" ? 'selected' : ''}}>SMP</option>
                            <option value="SMA" {{$dokter->pendidikan=="SMA" ? 'selected' : ''}}>SMA/SMK</option>
                            <option value="D1" {{$dokter->pendidikan=="D1" ? 'selected' : ''}}>D1</option>
                            <option value="D2" {{$dokter->pendidikan=="D2" ? 'selected' : ''}}>D2</option>
                            <option value="D3" {{$dokter->pendidikan=="D3" ? 'selected' : ''}}>D3</option>
                            <option value="D4" {{$dokter->pendidikan=="D4" ? 'selected' : ''}}>D4</option>
                            <option value="S1" {{$dokter->pendidikan=="S1" ? 'selected' : ''}}>S1</option>
                            <option value="S2" {{$dokter->pendidikan=="S2" ? 'selected' : ''}}>S2</option>
                            <option value="S3" {{$dokter->pendidikan=="S3" ? 'selected' : ''}}>S3</option>
                        </select>
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

@push('after-script')
<script type="text/javascript">
    $(document).ready(function () {
function showPassword() {
        if ($('#exampleCheck1').is(':checked')) {
            $('#password').attr('type', 'text');
        } else {
            $('#password').attr('type', 'password');
        }
    }

    // Function to add password fields
    function addPasswordFields() {
        var passwordInput = `
            <div class="mb-3" id="pss">
                <label for="exampleInputPassword1" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" autocomplete="off"
                    value="" placeholder="Password">
                @error('password')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        `;
        var passwordConfirmationInput = `
            <div class="mb-3" id="pass_confirm">
                <label class="form-label">Konfirmasi Kata Sandi <span class="text-danger">*</span></label>
                <input type="password" name="password_confirmation" class="form-control" placeholder="masukkan kata sandi sebelumnya" required>
                @error('password_confirmation')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        `;
        $('#ubah_password').append(passwordInput);
        $('#ubah_password').append(passwordConfirmationInput);
        $('#show_password').show();
        $('#labelchk').text('Ubah Password');
    }

    // Function to remove password fields
    function removePasswordFields() {
        $('#show_password').hide();
        $('#pss').remove();
        $('#pass_confirm').remove();
        $('#labelchk').text('Tidak mengubah password');
    }

   
    $('#exampleCheck1').click(function () {
        showPassword();
    });

    
    $('#chk').on('change', function () {
        if ($(this).is(':checked')) {
            addPasswordFields();
        } else {
            removePasswordFields();
        }
    });

   
    $('#show_password').hide();
});

</script>
@endpush
