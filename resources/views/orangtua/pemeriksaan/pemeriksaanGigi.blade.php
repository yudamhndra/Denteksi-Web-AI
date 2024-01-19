@extends('layout.master')

@section('navbar-title') pemeriksaan gigi @endsection
@section('content')

@if(session()->has('success'))

<div class="alert alert-success">
    {{ session()->get('success') }}
</div>
@endif
<div class="row">
    <div class="col-md-12 col-xl-12 ">
        <form action="{{ route('pemeriksaangigi.store') }}" class="col-md-12" id="pisik-store" method="post"
            enctype="multipart/form-data" files=true>
            @csrf
            <div class="card col-md-12 col-xl-12">
                <div class="card-body">
                    <h6 class="card-title">Data Anak</h6>
                    <div class="mb-3">
                        <label class="form-label">Nama Anak</label>
                        <select class=" form-select" name="anak" id="anak" data-width="100%">
                            <option selected disabled>Pilih Anak</option>
                            @foreach($anak as $anak)

                            <option value="{{$anak->id}}">{{$anak->nama}}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <div class="form-check form-switch mb-2">
                            <input type="checkbox" class="form-check-input" id="chk">
                            <label class="form-check-label" id="labelchk" for="formSwitch1">Belum Sekolah</label>
                        </div>
                    </div>

                    <div class=" mb-3">
                        <label for="exampleInputUsername2" class="form-label">Wilayah Kelurahan</label>
                        <div class="">
                            <select name="kelurahan" id="id_desa" class="js-example-basic-single form-select"
                                data-width="100%" placeholder="Pilih wilayah">
                                <option selected disabled>Pilih Kelurahan</option>
                                @foreach ($kelurahan as $id => $nama)
                                <option value="{{$id}}">{{$nama}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div id="data-sekolah">
                        <div class="mb-3">
                            <label for="exampleInputEmail2" class="form-label">Sekolah</label>
                            <div class="">
                                <select name="sekolah" id="id_sekolah" class="js-example-basic-single form-select "
                                    data-width="100%" placeholder="Pilih wilayah">
                                    <option selected disabled>Pilih Sekolah</option>
                                </select>
                            </div>
                        </div>

                        <div class=" mb-3">
                            <label for="exampleInputMobile" class="form-label">Kelas</label>
                            <div class="">
                                <select name="kelas" id="id_kelas" class="js-example-basic-single form-select"
                                    data-width="100%" placeholder="Pilih Kelas">
                                    <option selected disabled>Pilih Kelas</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div id="data-posyandu">
                        <div class="mb-3">
                            <label class="form-label">Posyandu</label>
                            <select class="js-example-basic-single form-select" data-width="100%" name="id_posyandu"
                                id="id_posyandu">
                            </select>
                        </div>
                    </div>

                </div>
            </div>
            <div class="card col-md-12 mt-3">
                <div class="card-body">
                    <h6 class="card-title">Pemeriksaan Gigi</h6>


                    <div class="">
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Foto gigi dari sisi depan</label>
                            <input type="file"  class="form-control dropify"  data-show-loader="true" data-allowed-file-extensions="jpg png jpeg svg"  name="gambar1" placeholder="masukkan gambar">
                            @error('gambar1')
                            <div class="badge bg-danger mt-2 ">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Foto gigi dari sisi kanan</label>
                            <input type="file" class="form-control dropify"  name="gambar2" placeholder="masukkan gambar">
                            @error('gambar2')
                            <div class="badge bg-danger mt-2 ">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Foto gigi dari sisi kiri</label>
                            <input type="file" class="form-control dropify" name="gambar3" placeholder="masukkan gambar">
                            @error('gambar3')
                            <div class="badge bg-danger mt-2 ">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Foto gigi dari sisi atas</label>
                            <input type="file" class="form-control dropify" name="gambar4" placeholder="masukkan gambar">
                        </div>

                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Foto gigi dari sisi bawah</label>
                            <input type="file" class="form-control dropify" name="gambar5" placeholder="masukkan gambar">
                        </div>

                    </div>
                </div>
            </div>

            <div class="card col-md-12 mt-3">
                <div class="card-body">
                <h6 class="card-title">Pemeriksaan Karies</h6>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Frekuensi menyikat gigi </label>
                        <select class="form-select" name="gsoal1" id="frekuensi"  data-width="100%">
                            <option selected disabled>Pilih salah satu</option>
                            <option>1 kali saat mandi </option>
                            <option>2 kali saat mandi </option>
                            <option>lebih dari 2 kali (saat mandi, setelah sarapan, dan sebelum tidur)</option>

                        </select>

                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Kunjungan ke dokter gigi</label>
                        <select class=" form-select" name="gsoal2" id="kunjungan"  data-width="100%">
                            <option selected disabled>Pilih salah satu </option>
                            <option>6 bulan sekali</option>
                            <option>12 bulan sekali</option>
                            <option>Saat sakit gigi saja </option>
                            <option>Tidak pernah</option>
                        </select>
                    </div>
                    <div id="form-karies">
                    @include('orangtua.pemeriksaan.resikoKaries')
                    </div>
                </div>
                <div class="mt-3 pb-3 float-right">
                    <div style="float: right">
                        <button type="submit" class="btn btn-primary me-2">Tambah</button>
                        <a href="{{URL::previous()}}" type="button" class="btn btn-secondary">Batal</a>
                    </div>
                </div>
            </div>



        </form>
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

    },
    error: {

        'imageFormat': 'Format yang diizinkan hanya jpg , jpeg, png , dan svg.'
    }
});
        $('#data-sekolah').hide();

        $('#chk').on('change', function () {
            if ($(this).is(':checked')) {
                $('#data-sekolah').show();
                $('#data-posyandu').hide();
                $('#id_sekolah').attr('name', 'sekolah');
                $('#labelchk').text('Sudah Sekolah');
                $('#id_posyandu').attr('name', ' ');
                $('#form-karies').hide();

            } else {
                $('#id_sekolah').attr('name', ' ');
                $('#data-sekolah').hide();
                $('#data-posyandu').show();
                $('#id_posyandu').attr('name', 'sekolah');
                $('#labelchk').text('Belum Sekolah');
                $('#form-karies').show();

            }
        });

        $('#anak').change(function () {
            let anak = $('#anak').val();
            console.log(anak);

        })

        $('#anak').select2({
            placeholder: 'Pilih anak',

        });

        $('#id_posyandu').select2({
            placeholder: 'Pilih posyandu',

        });
        $('#frekuensi').select2({
            placeholder: 'Pilih salah satu',

        });
        $('#kunjungan').select2({
            placeholder: 'Pilih salah satu',

        });



        $('#id_desa').change(function () {
            let kelurahan = $("#id_desa").val()
            let namadesa = $('#id_desa option:selected').text()

            $("#id_sekolah").children().remove();
            $("#id_sekolah").val('');
            $("#id_sekolah").append(' <option selected disabled>Pilih Sekolah</option>');
            $("#id_sekolah").prop('disabled', true)
            $("#id_kelas").children().remove();
            $("#id_kelas").val('');
            $("#id_kelas").append('<option selected disabled>Pilih Kelas</option>');
            $("#id_kelas").prop('disabled', true)
            $("#text-wilayah").empty()
            $("#text-wilayah").append(namadesa)
            $(".ket-data").show()

            if (kelurahan != '' && kelurahan != null) {
                $.ajax({
                    url: "{{url('')}}/list-sekolah/" + kelurahan,
                    success: function (res) {
                        $("#id_sekolah").prop('disabled', false)
                        let tampilan_option = '';
                        $.each(res, function (index, sekolah) {
                            tampilan_option +=
                                `<option value="${sekolah.id}">${sekolah.nama}</option>`
                        })
                        $("#id_sekolah").append(tampilan_option);
                    },
                });
            }
        });

        $('#id_sekolah').change(function () {
            let sekolah = $("#id_sekolah").val()
            $("#id_kelas").children().remove();
            $("#id_kelas").val('');
            $("#id_kelas").append(' <option selected disabled>Pilih Kelas</option>');
            $("#id_kelas").prop('disabled', true)
            if (sekolah != '' && sekolah != null) {
                $.ajax({
                    url: "{{url('')}}/list-kelas/" + sekolah,
                    success: function (res) {
                        $("#id_kelas").prop('disabled', false)
                        let tampilan_option = '';
                        $.each(res, function (index, kelas) {
                            tampilan_option +=
                                `<option value="${kelas.id}">${kelas.kelas}</option>`
                        })
                        $("#id_kelas").append(tampilan_option);
                    },
                });
            }
        });
        $('#id_desa').change(function () {
            let kelurahan = $("#id_desa").val()
            $("#id_posyandu").children().remove();
            $("#id_posyandu").val('');
            $("#id_posyandu").append(' <option selected disabled>Pilih Posyandu</option>');
            $("#id_posyandu").prop('disabled', true)
            if (kelurahan != '' && kelurahan != null) {
                $.ajax({
                    url: "{{url('')}}/list-posyandu/" + kelurahan,
                    success: function (res) {
                        $("#id_posyandu").prop('disabled', false)
                        let tampilan_option = '';
                        $.each(res, function (index, posyandu) {
                            tampilan_option +=
                                `<option value="${posyandu.id}">${posyandu.nama}</option>`
                        })
                        $("#id_posyandu").append(tampilan_option);

                    },
                });
            }
        });
        $("#pisik-store").validate({
            rules: {
                anak: "required",
                kelurahan:"required",
                kelas:"required",
                gsoal1:"required",
                gsoal2:"required",



            },
            messages: {
                anak: "Data anak wajib diisi",
                kelurahan: "kelurahan wajib diisi",
                kelas : "wajib diisi",
                gsoal1:"wajib diisi",
                gsoal2:"wajib diisi",



            },
             errorPlacement: function(error, element)
        {
        if ( element.is(":radio") )
        {
            error.appendTo( element.parents('.pilih') );
        }
        else
        { // This is the default behavior
            error.insertAfter( element );
        }
     },
            submitHandler: function(form) {
                form.submit();
            }

        });
    });

</script>
@endpush
