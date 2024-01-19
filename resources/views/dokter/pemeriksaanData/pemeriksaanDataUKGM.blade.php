@extends('layout.master')

@section('title')
    odontogram
@endsection
@section('content')

<div class="container-fluid">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('dokter.periksaUKGM')}}">Pemeriksaan Gigi</a></li>
            <li class="breadcrumb-item active" aria-current="page">
                {{ucwords($data->anak->nama)}}
            </li>
        </ol>
    </nav>
    <form method="post" id="form-skrining-gigi">
    @csrf
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div id="wizard" >
                        <h2>Pengisian Odontogram</h2>
                        <section style="width: 100%;">
                            <div class="row">
                                <div class="col-md-12">
                                    <div>
                                        <strong>PENGISIAN ODONTOGRAM</strong>
                                        <p>Pilih posisi gigi dan klik aksi yang seseuai dengan kondisi gigi anak</p>
                                        <div class="w-100 mb-1 d-flex list-image-pemeriksaan">
                                            @for($i=1; $i<=5; $i++)
                                                @php $img = 'gambar'.$i;
                                                    $imgPath = "storage/gigi/$data[$img]";
                                                    $placeholderPath = "assets/images/others/placeholder.jpg";
                                                @endphp
                                                <div style="width: 150px;height: 100px;overflow: hidden;">
                                                    @if(!empty($data[$img]) && File::exists(public_path($imgPath)))
                                                        <img src='{{@asset("storage/gigi/$data[$img]")}}' data-bs-toggle="modal" data-bs-target="#modal-image" style="width: 100%; height: 100%;object-fit: cover;" class="rounded img-thumbnail " alt="...">
                                                    @else
                                                        <img src="{{@asset('assets/images/others/placeholder.jpg') }}" data-bs-toggle="modal" data-bs-target="#modal-image" style="width: 100%; height: 100%;object-fit: cover;" class="rounded img-thumbnail " alt="...">
                                                    @endif
                                                </div>
                                            @endfor
                                        </div>
                                        <div class="w-100 mb-1 d-flex list-image-pemeriksaan">
                                            @for($i = 1; $i <= 5; $i++)
                                                @php $img = 'gambar'.$i; @endphp
                                                <div style="width: 150px;height: 100px;overflow: hidden;">
                                                    @if (!empty($images[$i-1]['image']))
                                                        <img  src="data:image/jpeg;base64,{{ base64_encode($images[$i-1]['image']) }}" data-bs-toggle="modal" data-bs-target="#modal-image" style="width: 100%; height: 100%;object-fit: cover;" class="rounded img-thumbnail " alt="{{ $images[$i-1]['filename'] }}">
                                                    @else
                                                        <img src="{{ asset('assets/images/others/placeholder.jpg') }}" data-bs-toggle="modal" data-bs-target="#modal-image" style="width: 100%; height: 100%;object-fit: cover;" class="rounded img-thumbnail " alt="...">
                                                    @endif
                                                </div>
                                            @endfor
                                        </div>

                                    </div>

                                </div>
                            </div>
                            <div class="row">

                                <div class="col-md-9">

                                    <!-- <div class="border border-light m-1 h-75"> -->
                                    <div class="border border-light h-100 w-100 text-center" style="line-height: 0;">
                                        @include('dokter.pemeriksaanData.odontogram')
                                    </div>
                                    <div class="form-check mt-2 pb-3">
                                        <input type="checkbox" class="form-check-input" id="validation-skrining">
                                        <label class="form-check-label" for="validation-skrining">
                                            <strong>VALIDASI</strong> Pemeriksaan odontogram telah sesuai kondisi gigi anak
                                        </label>
                                    </div>
                                    <!-- </div> -->
                                </div>
                                <div class="col-md-3">
                                    <div class="d-flex flex-column bd-highlight mb-3">
                                        <div class="p-2 bd-highlight"><strong>Aksi:</strong></div>
                                        <div class="p-2 bd-highlight">
                                            <div class="btn-group-vertical me-1" role="group" aria-label="Vertical button group">
                                                <button type="button" class="btn btn-light btn-group-aksi btn-aksi" style="text-align:left;" id="belum-erupsi"><img src="{{asset('pemeriksaan/belum-erupsi.png')}}" alt="">&nbsp<span class="align-middle">Belum Erupsi</span></button>
                                                <button type="button" class="btn btn-light btn-group-aksi btn-aksi" style="text-align:left;" id="erupsi-sebagian"><img src="{{asset('pemeriksaan/erupsi-sebagian.png')}}" alt="">&nbsp<span class="align-middle">Erupsi Sebagian</span></button>
                                                <button type="button" class="btn btn-light btn-group-aksi btn-aksi" style="text-align:left;" id="karies"><img src="{{asset('pemeriksaan/karies.png')}}" alt="">&nbsp<span class="align-middle">Karies</span></button>
                                                <button type="button" class="btn btn-light btn-group-aksi btn-aksi" style="text-align:left;" id="non-vital"><img src="{{asset('pemeriksaan/non-vital.png')}}" alt="">&nbsp<span class="align-middle">Non Vital</span></button>
                                                <button type="button" class="btn btn-light btn-group-aksi btn-aksi" style="text-align:left;" id="tambalan-logam"><img src="{{asset('pemeriksaan/tambalan-logam.png')}}" alt="">&nbsp<span class="align-middle">Tambalan Logam</span></button>
                                                <button type="button" class="btn btn-light btn-group-aksi btn-aksi" style="text-align:left;" id="tambalan-non-logam"><img src="{{asset('pemeriksaan/tambalan-non-logam.png')}}" alt="">&nbsp<span class="align-middle">Tambalan Non Logam</span></button>
                                                <button type="button" class="btn btn-light btn-group-aksi btn-aksi" style="text-align:left;" id="mahkota-logam"><img src="{{asset('pemeriksaan/mahkota-logam.png')}}" alt="">&nbsp<span class="align-middle">Mahkota Logam</span></button>
                                                <button type="button" class="btn btn-light btn-group-aksi btn-aksi" style="text-align:left;" id="mahkota-non-logam"><img src="{{asset('pemeriksaan/mahkota-non-logam.png')}}" alt="">&nbsp<span class="align-middle">Mahkota Non Logam</span></button>
                                                <button type="button" class="btn btn-light btn-group-aksi btn-aksi" style="text-align:left;" id="sisa-akar"><img src="{{asset('pemeriksaan/sisa-akar.png')}}" alt="">&nbsp<span class="align-middle">Sisa Akar</span></button>
                                                <button type="button" class="btn btn-light btn-group-aksi btn-aksi" style="text-align:left;" id="gigi-hilang"><img src="{{asset('pemeriksaan/gigi-hilang.png')}}" alt="">&nbsp<span class="align-middle">Gigi Hilang</span></button>
                                                <button type="button" class="btn btn-light btn-group-aksi btn-aksi" style="text-align:left;" id="jembatan"><img src="{{asset('pemeriksaan/jembatan.png')}}" alt="">&nbsp<span class="align-middle">Jembatan</span></button>
                                                <button type="button" class="btn btn-light btn-group-aksi btn-aksi" style="text-align:left;" id="gigi-tiruan-lepas"><img src="{{asset('pemeriksaan/gigi-tiruan-lepas.png')}}" alt="">&nbsp<span class="align-middle">Gigi Tiruan Lepas</span></button>
                                                <button type="button" class="btn btn-danger btn-group-aksi" id="hapus-aksi">HAPUS AKSI</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>

                        <h2>Skrining Indeks</h2>
                        <section>
                            <div class="col-md-12 grid-margin stretch-card">
                                <div class="card">
                                    <div class="card-body">
                                        <h6 class="card-title">SKOR def t</h6>
                                            <div class="row mb-3">
                                                <label for="d" class="col-sm-1 col-form-label">d</label>
                                                <div class="col-sm-2">
                                                    <input type="number" name="def_d" class="form-control skor-d"
                                                        value="{{@$data->skriningIndeks->def_d ?: 0}}" min="0">
                                                </div>
                                                <label for="e" class="col-sm-1 col-form-label">e</label>
                                                <div class="col-sm-2">
                                                    <input type="number" name="def_e" class="form-control skor-e"
                                                        value="{{@$data->skriningIndeks->def_e ?: 0}}" min="0">
                                                </div>
                                                <label for="f" class="col-sm-1 col-form-label">f</label>
                                                <div class="col-sm-2">
                                                    <input type="number" name="def_f" class="form-control skor-f"
                                                        value="{{@$data->skriningIndeks->def_f ?: 0}}" min="0">
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label for="readonlyDEFT" class="col-sm-1 col-form-label">def-t</label>
                                                <div class="col-sm-1">
                                                    <input type="number" name="def_t" class="form-control total-skor" readonly
                                                        value="{{@$data->skriningIndeks->def_d + @$data->skriningIndeks->def_e + @$data->skriningIndeks->def_f ?: 0}}">
                                                </div>
                                            </div>
                                        <h6 class="card-title">SKOR DMF-T</h6>
                                            <div class="row mb-3">
                                                <label for="d" class="col-sm-1 col-form-label">D</label>
                                                <div class="col-sm-2">
                                                    <input type="number" name="dmf_d" class="form-control skor-D"
                                                        value="{{@$data->skriningIndeks->dmf_d ?: 0}}" min="0">
                                                </div>
                                                <label for="m" class="col-sm-1 col-form-label">M</label>
                                                <div class="col-sm-2">
                                                    <input type="number" name="dmf_e" class="form-control skor-M"
                                                        value="{{@$data->skriningIndeks->dmf_e ?: 0}}" min="0">
                                                </div>
                                                <label for="f" class="col-sm-1 col-form-label">F</label>
                                                <div class="col-sm-2">
                                                    <input type="number" name="dmf_f" class="form-control skor-F"
                                                        value="{{@$data->skriningIndeks->dmf_f ?: 0}}" min="0">
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label for="readonlyDMFT" class="col-sm-1 col-form-label">DMF-T</label>
                                                <div class="col-sm-1">
                                                    <input type="number" name="dmf_t" class="form-control total-skor" readonly
                                                        value="{{@$data->skriningIndeks->dmf_d + @$data->skriningIndeks->dmf_e + @$data->skriningIndeks->dmf_f ?: 0}}">
                                                </div>
                                            </div>
                                    </div>
                                </div>
                            </div>
                        </section>

                        <h2>Peneliaian Resiko Karies</h2>
                        <section >
                            <div class="container p-1">
                                <div class="row">
                                    <div class="col-md-15 grid-margin stretch-card">
                                        <div class="card bg-light ">
                                            <div class="card-body">
                                                <div class="card-text">
                                                    <p style="font-weight:bold;">PENILAIAN RISIKO KARIES</p>
                                                    <div class="row mb-3 ">
                                                        <label for="nama" class="col-sm-3 col-form-label">Penilaian
                                                            Risiko
                                                            Karies Anak
                                                        </label>
                                                        <div class="col-sm-5">
                                                            @php $resiko = ['Tinggi','Sedang','Rendah'] @endphp
                                                            <select class="form-select" name="penilaian_risiko_karies"
                                                                data-width="100%" placeholder="Pilih Resiko">
                                                                <option selected disabled>Pilih Resiko</option>
                                                                <option value="rendah"  {{($data->resikoKaries->rksoal7=="ya"||$data->resikoKaries->rksoal8=="ya"||$data->resikoKaries->rksoal9=="ya")? 'selected':'' }}>Rendah</option>
                                                                <option value="sedang"  {{($data->resikoKaries->rksoal5=="ya"||$data->resikoKaries->rksoal6=="ya"||$data->resikoKaries->rksoal13=="ya")? 'selected':'' }}>Sedang</option>
                                                                <option value="tinggi" {{($data->resikoKaries->rksoal1=="ya"|| $data->resikoKaries->rksoal2=="ya" ||
                                                                    $data->resikoKaries->rksoal3=="ya" || $data->resikoKaries->rksoal4=="ya" ||$data->resikoKaries->rksoal10=="ya" ||$data->resikoKaries->rksoal11=="ya"||$data->resikoKaries->rksoal12 == "ya")? 'selected':'' }}>Tinggi</option>

                                                                <!-- @foreach ($resiko as $item)
                                                                @if(@$data->resikoKaries->rksoal1=="ya")
                                                                <option value="tinggi" {{strtolower($item) == @$data->resikoKaries->penilaian ? 'selected':''}}>{{$item}}</option>
                                                                @endif
                                                                @endforeach -->
                                                            </select>
                                                        </div>

                                                        <div class ="col=md-4">
                                                            <img src="" alt="">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="container p-1">
                                    @include('dokter.pemeriksaanData.resikokaries')
                                </div>
                            </div>
                        </section>

                        <h2>Hasil Pemeriksaan</h2>
                        <section>
                            <div class="row mb-3">
                                <label for="diagnosa" class="col-sm-2 col-form-label">Diagnosa</label>
                                <div class="col-sm-10">
                                <textarea name="diagnosa" class="form-control w-100" id="" rows="2">{{@$data->skriningIndeks->diagnosa}}</textarea>

                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="rekomendasi" class="col-sm-2 col-form-label">Rekomendasi</label>
                                <div class="col-sm-10">
                                    <textarea name="rekomendasi" class="form-control w-100" id="" rows="2">{{@$data->skriningIndeks->rekomendasi}}</textarea>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="rekomendasi" class="col-sm-2 col-form-label">Tindakan Lanjut?</label>
                                <div class="col-sm-10">
                                    <div class="form-check form-check-inline">
                                        <input type="radio" class="form-check-input" value="ya" name="reservasi"
                                               id="radioInline" {{ (@$data->skriningIndeks->reservasi=="ya")? "checked" : "" }} >
                                        <label class="form-check-label" for="radioInline">
                                            Ya
                                        </label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input type="radio" value="tidak" class="form-check-input" name="reservasi"
                                               id="radioInline1" {{ (@$data->skriningIndeks->reservasi=="tidak")? "checked" : "" }}>
                                        <label class="form-check-label" for="radioInline1">
                                            Tidak
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-12 grid-margin stretch-card">
            <div class="card" id="keterangan">
                <div class="card-body">
                    <p class="text-muted">KETERANGAN: </p>
                    @foreach($aksi as $value)
                        <div class="row mb-3">
                            <label for="" class="col-sm-3 col-form-label">{{ str_replace('_', ' ', ucfirst($value)) }}</label>
                            <div class="col-sm-9">
                                @php
                                    $positions = @$data->skriningOdontogram->where('aksi', $value)->pluck('posisi')->toArray();
                                    $positionString = implode(',', array_filter($positions));
                                @endphp
                                <input type="text" id="field-{{$value}}" class="form-control" value="{{ substr_count($positionString, 'p') }}" readonly>
                                <input type="hidden" id="h-{{$value}}" name="aksi[{{$value}}]" value="{{ $positionString }}">
                                <span class="posisi-gigi">{{ strtoupper($positionString) }}</span>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    </form>
</div>
<!-- modal -->
<div class="modal fade" id="modal-image" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
      </div>
      <div class="modal-body">
        <div class="w-100 text-center">
            <img src="" alt="" id="img-in-modal" class="img-fluid">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
      </div>
    </div>
  </div>
</div>
@endsection
@push('after-style')
<style>
    .wizard > .content {
        min-height: 75vh !important;
    }
</style>
@endpush
@push('after-script')
<script>
    var imageSrc;
    var arrayAksi = {'belum-erupsi':[],'erupsi-sebagian':[],'karies':[],'non-vital':[],'tambalan-logam':[],'tambalan-non-logam':[],'mahkota-logam':[],'mahkota-non-logam':[],'sisa-akar':[],'gigi-hilang':[],'jembatan':[],'gigi-tiruan-lepas':[]}
    $(document).ready(function(){
        $("#wizard").steps({
            headerTag: "h2",
            bodyTag: "section",
            transitionEffect: "slideLeft",
            autoFocus: true,
            labels: {
                finish: "Submit",
                next: "Lanjut",
                previous: "Kembali"
            },
            onStepChanging:function(){
                let validation = $("#validation-skrining").is(':checked');
                if (!validation) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Silahkan lakukan validasi terlebih dahulu',
                        showConfirmButton: false,
                    });
                    return false;
                } else {
                    return true;
                }
            },
            onStepChanged:function(event, currentIndex, newIndex){
                if(currentIndex == 0){
                    document.getElementById("keterangan").style.display = "";
                }else{
                    document.getElementById("keterangan").style.display = "none";
                }
                return true;
            },
            onFinished: function(event, currentIndex) {
                const formData = new FormData(document.getElementById("form-skrining-gigi"));
                formData.append('id_pemeriksaan', "{{$data->id}}");
                $.ajax({
                    'type': 'POST',
                    'url': "{{route('dokter.storePemeriksaanDataUkgm')}}",
                    'data': formData,
                    'processData': false,
                    'contentType': false,
                    'dataType': 'JSON',
                    'success': function (data) {
                        if(data.success){
                            window.location.href = "{{ route('dokter.periksaUKGM') }}";
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Terjadi kesalahan!',
                                showConfirmButton: false,
                            });
                        }
                    },
                });
            }
        });

        $(document).on("change","input[name=def_d],input[name=def_e],input[name=def_f]", function(){
            let total = parseInt($("input[name=def_d]").val()) + parseInt($("input[name=def_e]").val()) + parseInt($("input[name=def_f]").val());
            $("input[name=def_t]").val(total);
        });

        $(document).on("change","input[name=dmf_d],input[name=dmf_e],input[name=dmf_f]", function(){
            let total = parseInt($("input[name=dmf_d]").val()) + parseInt($("input[name=dmf_e]").val()) + parseInt($("input[name=dmf_f]").val());
            $("input[name=dmf_t]").val(total);
        });

        $('.list-image-pemeriksaan img').click(function() {
            imageSrc = $(this).attr('src');
        });

        $('#modal-image').on('shown.bs.modal', function (e) {
            $("#img-in-modal").attr('src', imageSrc  );
        });

        $('#modal-image').on('hide.bs.modal', function (e) {
            $("#img-in-modal").attr('src','');
        });

        // edit odontogram
        if ("{{$data->skriningOdontogram->isNotEmpty()}}") {
            var data = "{{$data->skriningOdontogram}}";
            const obj = JSON.parse(data.replace(/&quot;/g, '"'));
            $.each(obj, function(index, value){
                let x, y, color, element, type, posisi = value.posisi || "";
                let arrayPosisi = posisi.split(',');
                $.each(arrayPosisi, function(index2, value2){
                    if (value.posisi != null) {
                        arrayAksi[value.aksi].push(value2);
                        switch (value.aksi) {
                            case 'belum-erupsi':
                                type = 'insert-text';
                                x = 1.5; y = 15;
                                color = '#5D5FEF';
                                style = 'font-size: 10pt;font-weight:bold;cursor:default';
                                element = 'UE';
                                console.log('belum-erupsi');
                                break;
                            case 'erupsi-sebagian':
                                type = 'insert-text';
                                x = 1.5; y = 15;
                                color = '#5D5FEF';
                                style = 'font-size: 10pt;font-weight:bold;cursor:default';
                                element = 'PE';
                                break;
                            case 'karies':
                                type = 'insert-fill';
                                color = 'grey';
                                break;
                            case 'non-vital':
                                type = 'insert-non-vital';
                                style = 'stroke-width:2';
                                color = '#C71616';
                                break;
                            case 'tambalan-logam':
                                type = 'insert-fill';
                                color = 'pink';
                                break;
                            case 'tambalan-non-logam':
                                type = 'insert-fill';
                                color = 'blue';
                                break;
                            case 'mahkota-logam':
                                type = 'insert-fill';
                                color = 'green';
                                break;
                            case 'mahkota-non-logam':
                                type = 'insert-fill';
                                color = '#66D1D1';
                                break;
                            case 'sisa-akar':
                                type = 'insert-text';
                                x = 3.5; y = 17;
                                color = '#5D5FEF';
                                style = 'font-size: 15pt;font-weight:bold;cursor:default';
                                element = 'V';
                                break;
                            case 'gigi-hilang':
                                type = 'insert-text';
                                x = 3.5; y = 17;
                                color = '#C71616';
                                style = 'font-size: 15pt;font-weight:bold;cursor:default';
                                element = 'X';
                                break;
                            case 'jembatan':
                                type = 'insert-line';
                                color = '#048A3F';
                                style = 'stroke-width:2';
                                break;
                            case 'gigi-tiruan-lepas':
                                type = 'insert-line';
                                color = '#E4AA04';
                                style = 'stroke-width:2';
                                break;
                        }
                    }

                    if (type == 'insert-text') {
                        d3.select('g#'+value2).append('text').attr('id',value2).attr('type','insert-text').attr('x', x).attr('y', y).attr('stroke', color).attr('fill', color).attr('stroke-width', '0.1').attr('style', style).text(element);
                    } else if (type == 'insert-line') {
                        d3.select('g#'+value2).append('line').attr('id',value2).attr('type','insert-line').attr('x1', '20').attr('y1', '10').attr('x2', '0').attr('y2', '10').attr('stroke',color).attr('style', style);
                    } else if (type == 'insert-non-vital') {
                        d3.select('g#'+value2).append('line').attr('id',value2).attr('type','insert-non-vital').attr('x1', '5').attr('y1', '15').attr('x2', '0').attr('y2', '15').attr('stroke',color).attr('style', style);
                        d3.select('g#'+value2).append('line').attr('id',value2).attr('type','insert-non-vital').attr('x1', '15').attr('y1', '5').attr('x2', '5').attr('y2', '15').attr('stroke',color).attr('style', style);
                        d3.select('g#'+value2).append('line').attr('id',value2).attr('type','insert-non-vital').attr('x1', '20').attr('y1', '5').attr('x2', '15').attr('y2', '5').attr('stroke',color).attr('style', style);
                    } else if (type == 'insert-fill'){
                        let id = value2.split('-');
                        d3.select('g#'+id[0]+' polygon#'+id[1]).attr('fill', color).attr('type','insert-fill');
                    }
                });
            });
        }
    });
</script>
<script src="{{asset('assets/js/skrining-odontogram.js')}}"></script>
@endpush
