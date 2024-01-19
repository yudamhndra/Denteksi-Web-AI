@extends('layout.master')

@section('title') pemeriksaan fisik @endsection
@section('content')

<div class="row">
    @if(session()->has('error'))
    <div class="alert alert-danger">
        {{ session()->get('error') }}
    </div>
    @endif

    <div class="col-md-12 grid-margin stretch-card">
        <form action="{{ route('pemeriksaanfisik.store') }}" class="col-md-12" id="pisik-store" method="post"
            nctype="multipart/form-data" files=true>
            @csrf
            <div class="card col-md-12">
                <div class="card-body">
                    <h6 class="card-title">Pemeriksaan</h6>


                    <div class="mb-3">
                        <label class="form-label">Nama Anak</label>
                        <select class=" form-select" name="anak" id="anak" data-width="100%">
                            <option value="clear">Pilih Anak</option>  
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
                                <option selected disabled>Pilih Wilayah</option>
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
                        <select class="form-select" data-width="100%" id="id_posyandu">

                        </select>
                    </div>
                    </div>
                    <div class="hasilimt">
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Berat badan</label>
                            <input type="text" min="0" class="form-control" id="berat_badan" name="berat_badan"
                                autocomplete="off" placeholder="masukkan berat badan" value="">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">tinggi badan</label>
                            <input type="text" min="0" class="form-control" id="tinggi_badan" name="tinggi_badan"
                                autocomplete="off" placeholder="Masukkan Tinggi Badan" value="">
                            @error('tinggi_badan')
                            <div class="badge bg-danger mt-2 ">{{ $message }}</div>
                            @enderror
                        </div>


                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">imt</label>
                            <input type="text" class="form-control" value="harap isi berat badan dan tinggi badan"
                                id="imt" readonly="">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">sistole</label>
                        <input type="number" class="form-control" id="sistole" name="sistole" autocomplete="off"
                            placeholder="masukkan kelas">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">diastole</label>
                        <input type="number" class="form-control" id="diastole" name="diastole" autocomplete="off"
                            placeholder="masukkan kelas">
                    </div>
                </div>
            </div>

            <div class="card col-md-12 mt-2">
                <div class="card-body">
                    <h6 class="card-title">Pemeriksaan Mata</h6>
                    <p style="font-size:12px" class="card-text text-secondary mb-3">Pilih ya atau tidak dari pertanyaan
                        gejala sakit mata </p>

                    <div class="mb-3">
                        <label class="col-md-12 mb-2">Mata perih / merah dan bengkak </label>
                        <div class="form-check form-check-inline">
                            <input type="radio" class="form-check-input" value="ya" name="msoal1" id="radioInline"
                                require>
                            <label class="form-check-label" for="radioInline">
                                Ya
                            </label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input type="radio" value="tidak" class="form-check-input" name="msoal1" id="radioInline1">
                            <label class="form-check-label" for="radioInline1">
                                Tidak
                            </label>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="col-md-12 mb-2"> Tidak dapat melihat / membaca dengan jelas </label>
                        <div class="form-check form-check-inline">
                            <input type="radio" class="form-check-input" value="ya" name="msoal2" id="radioInline">
                            <label class="form-check-label" for="radioInline">
                                Ya
                            </label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input type="radio" value="tidak" class="form-check-input" name="msoal2" id="radioInline1">
                            <label class="form-check-label" for="radioInline1">
                                Tidak
                            </label>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="col-md-12 mb-2"> Menggunakan kacamata </label>
                        <div class="form-check form-check-inline">
                            <input type="radio" class="form-check-input" value="normal" name="msoal3" id="radioInline">
                            <label class="form-check-label" for="radioInline">
                                Tidak
                            </label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input type="radio" value="minus" class="form-check-input selected" name="msoal3"
                                id="radioInline1">
                            <label class="form-check-label" for="radioInline1">
                                Ya, Minus
                            </label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input type="radio" value="silinder" class="form-check-input selected" name="msoal3"
                                id="radioInline1">
                            <label class="form-check-label" for="radioInline1">
                                Ya, Silinder
                            </label>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="col-md-12 mb-2"> Mata juling </label>
                        <div class="form-check form-check-inline">
                            <input type="radio" class="form-check-input" value="ya" name="msoal4" id="radioInline">
                            <label class="form-check-label" for="radioInline">
                                Ya
                            </label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input type="radio" value="tidak" class="form-check-input" name="msoal4" id="radioInline1">
                            <label class="form-check-label" for="radioInline1">
                                Tidak
                            </label>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="col-md-12 mb-2"> Tidak dapat membedakan warna dengan baik </label>
                        <div class="form-check form-check-inline">
                            <input type="radio" class="form-check-input" value="ya" name="msoal5" id="radioInline">
                            <label class="form-check-label" for="radioInline">
                                Ya
                            </label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input type="radio" value="tidak" class="form-check-input" name="msoal5" id="radioInline1">
                            <label class="form-check-label" for="radioInline1">
                                Tidak
                            </label>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Berapa lama waktu menonton TV + melihat
                            gadget seperti HP/tablet + melihat layar komputer dalam 1 hari (Jam) </label>
                        <input type="text" class="form-control" name="msoal6" autocomplete="off" placeholder="">
                    </div>


                </div>
            </div>

            <div class="card col-md-12 mt-2">
                <div class="card-body">
                    <h6 class="card-title">Pemeriksaan Telinga</h6>
                    <p style="font-size:12px" class="card-text text-secondary mb-3">Pilih ya atau tidak dari pertanyaan
                        gejala pendengaran </p>

                    <div class="mb-3">
                        <label class="col-md-12 mb-2">Tidak merespon bila ada suara keras </label>
                        <div class="form-check form-check-inline">
                            <input type="radio" class="form-check-input" value="ya" name="tsoal1" id="radioInline">
                            <label class="form-check-label" for="radioInline">
                                Ya
                            </label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input type="radio" value="tidak" class="form-check-input" name="tsoal1" id="radioInline1">
                            <label class="form-check-label" for="radioInline1">
                                Tidak
                            </label>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="col-md-12 mb-2"> Tidak mendengar bila dipanggil </label>
                        <div class="form-check form-check-inline">
                            <input type="radio" class="form-check-input" value="ya" name="tsoal2" id="radioInline">
                            <label class="form-check-label" for="radioInline">
                                Ya
                            </label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input type="radio" value="tidak" class="form-check-input" name="tsoal2" id="radioInline1">
                            <label class="form-check-label" for="radioInline1">
                                Tidak
                            </label>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="col-md-12 mb-2"> Tidak dapat mendengar dengan jelas </label>
                        <div class="form-check form-check-inline">
                            <input type="radio" class="form-check-input" value="ya" name="tsoal3" id="radioInline">
                            <label class="form-check-label" for="radioInline">
                                Ya
                            </label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input type="radio" value="tidak" class="form-check-input" name="tsoal3" id="radioInline1">
                            <label class="form-check-label" for="radioInline1">
                                Tidak
                            </label>
                        </div>
                    </div>



                    <div class="mb-3">
                        <label class="col-md-12 mb-2"> Keluar cairan dari telinga </label>
                        <div class="form-check form-check-inline">
                            <input type="radio" class="form-check-input" value="ya" name="tsoal4" id="radioInline">
                            <label class="form-check-label" for="radioInline">
                                Ya
                            </label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input type="radio" value="tidak" class="form-check-input" name="tsoal4" id="radioInline1">
                            <label class="form-check-label" for="radioInline1">
                                Tidak
                            </label>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="col-md-12 mb-2"> Telinga terasa tertutup atau tersumbat </label>
                        <div class="form-check form-check-inline">
                            <input type="radio" class="form-check-input" value="ya" name="tsoal5" id="radioInline">
                            <label class="form-check-label" for="radioInline">
                                Ya
                            </label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input type="radio" value="tidak" class="form-check-input" name="tsoal5" id="radioInline1">
                            <label class="form-check-label" for="radioInline1">
                                Tidak
                            </label>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="col-md-12 mb-2"> Nyeri telinga </label>
                        <div class="form-check form-check-inline">
                            <input type="radio" class="form-check-input" value="ya" name="tsoal6" id="radioInline">
                            <label class="form-check-label" for="radioInline">
                                Ya
                            </label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input type="radio" value="tidak" class="form-check-input" name="tsoal6" id="radioInline1">
                            <label class="form-check-label" for="radioInline1">
                                Tidak
                            </label>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Volume saat menonton TV atau mendengar
                            radio </label>
                        <input type="text" class="form-control" name="tsoal7" autocomplete="off" placeholder=""
                            required>
                    </div>


                </div>
            </div>

            <div class="mt-3">
                <button type="submit" class="btn btn-primary me-2">Submit</button>
                <button class="btn btn-secondary">Cancel</button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('after-script')

<script type="text/javascript">
    $(document).ready(function () {
        $('#data-sekolah').hide();
        $('#chk').on('change', function () {
            if ($(this).is(':checked')) {
                $('#data-sekolah').show();
                $('#data-posyandu').hide();
                $('#id_sekolah').attr('name', 'sekolah');
                $('#labelchk').text('Sudah Sekolah');
                $('#id_posyandu').attr('name', ' ');

            } else {
                $('#id_sekolah').attr('name', ' ');
                $('#data-sekolah').hide();
                $('#data-posyandu').show();
                $('#id_posyandu').attr('name', 'sekolah');
                $('#labelchk').text('Belum Sekolah');
            }
        });

        $(" #berat_badan,#tinggi_badan").keyup(function () {
            var bb = $("#berat_badan").val();
            var tb = $("#tinggi_badan").val();
            console.log(bb)
            console.log(tb)
            tb /= 100
            console.log(tb)


            if (bb != "" && tb != "") {
                var imt = bb / (tb * tb);
                imtfix = imt.toFixed(1)
                console.log(imtfix)

                if (imt >= 27) {
                    $("#imt").removeClass("bg-success bg-info");
                    $("#imt").addClass("bg-danger");
                    $("#imt").val(imtfix + " (Obesitas)");
                } else if ((imtfix >= 25.1) & (imtfix < 27)) {
                    $("#imt").addClass("bg-danger");
                    $("#imt").removeClass("bg-success bg-info");
                    $("#imt").val(imtfix + " (Gemuk)");
                } else if ((imtfix >= 18.5) & (imtfix <= 25)) {
                    $("#imt").removeClass("bg-danger bg-info");
                    $("#imt").addClass("bg-success");
                    $("#imt").val(imtfix + " (Normal)");
                } else if ((imtfix >= 17) & (imtfix <= 18.4)) {
                    $("#imt").addClass("bg-info");
                    $("#imt").removeClass("bg-success bg-danger");
                    $("#imt").val(imtfix + " (Kurus)");
                } else {
                    $("#imt").addClass("bg-info");
                    $("#imt").removeClass("bg-success bg-danger");
                    $("#imt").val(imtfix + " (Sangat Kurus)");
                }
            } else if (bb == "" && tb != "") {
                $("#imt").removeClass("bg-danger bg-success bg-info");

                $("#imt").val("harap isi berat badan");
            } else if (bb != "" && tb == "") {
                $("#imt").removeClass("bg-danger bg-success bg-info");
                $("#imt").val("harap isi tinggi badan");
            } else if (bb == "" && tb == "") {
                $("#imt").removeClass("bg-danger bg-success bg-info");
                $("#imt").val("harap isi berat badan dan tinggi badan");
            }


        });
        $('#anak').change(function () {
            let anak = $('#anak').val();
            console.log(anak);

        })

        $('#anak').select2({
            placeholder: 'Pilih anak',

        });
   

    $('#id_desa').change(function () {
        let kelurahan = $("#id_desa").val()
        let namadesa = $('#id_desa option:selected').text()

        $("#id_sekolah").children().remove();
        $("#id_sekolah").val('');
        $("#id_sekolah").append('<option value="">---Pilih Sekolah---</option>');
        $("#id_sekolah").prop('disabled', true)
        $("#id_kelas").children().remove();
        $("#id_kelas").val('');
        $("#id_kelas").append('<option disable value="">---Pilih Kelas---</option>');
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
        $("#id_kelas").append('<option value="">---Pilih Kelas---</option>');
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
            $("#id_posyandu").append('<option value="">---Pilih Posyandu---</option>');
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
});

</script>
@endpush
