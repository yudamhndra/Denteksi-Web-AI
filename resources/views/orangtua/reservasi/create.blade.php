@extends('layout.master')

@section('title') reservasi @endsection
@section('content')
<div class="card">
    <div class="card-body">
        <div class="card-title">
            <h4 class="mb-0">Reservasi</h4>
        </div>
        <hr />
        <div class="panel-body">
            <form class="form-horizontal form-validate-jquery" action="{{route('reservasi.store')}}" method="post" enctype="multipart/form-data" files=true>
                {{ csrf_field() }}
                <fieldset class="content-group mb-3">
                    <div class="form-group mb-3">
                        <label class="control-label">Nama <span class="text-danger">*</span></label>
                        <input type="text" name="anak" class="form-control" value="{{ $anak->id}}" hidden>
                        <input type="text" name="" class="form-control" value="{{ $anak->nama}}" readonly>
                        @if ($errors->has('nama'))
                        <label style="padding-top:7px;color:#F44336;">
                            <strong><i class="fa fa-times-circle"></i> {{ $errors->first('nama') }}</strong>
                        </label>
                        @endif
                    </div>
                    <div class="form-group mb-3">
                        <label class="control-label">Layanan Kesehatan <span class="text-danger">*</span></label>
                        <select class="form-select" name="poli">
                            <option selected disabled>Pilih layanan kesehatan...</option>
                            @foreach ($klinik as $value)
                            <option value="{{$value->id}}" {{
                                old('poli') === $value->id ? 'selected' : ''
                            }}>{{$value->poli}}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('poli'))
                        <label style="padding-top:7px;color:#F44336;">
                            <strong><i class="fa fa-times-circle"></i> {{ $errors->first('poli') }}</strong>
                        </label>
                        @endif
                    </div>
                    <div id="senyumin-features">
                        <div class="form-group mb-3">
                            <label class="control-label col-lg-2">Tanggal Pemeriksaan <span class="text-danger">*</span></label>
                            <input type="date" name="tanggal" class="form-control" placeholder="Pilih tanggal pemeriksaan dibawah ini" readonly>
                            <div class="d-flex flex-wrap" id="tanggal">
                            </div>
                            @if ($errors->has('tanggal'))
                            <label style="padding-top:7px;color:#F44336;">
                                <strong><i class="fa fa-times-circle"></i> {{ $errors->first('tanggal') }}</strong>
                            </label>
                            @endif
                        </div>
                        <div class="form-group mb-3">
                            <label class="control-label col-lg-2">Keluhan <span class="text-danger">*</span></label>
                            <textarea type="text" name="keluhan"  rows="3" class="form-control"  placeholder="">{{$reservasi->diagnosa}}</textarea>
                            @if ($errors->has('keluhan'))
                            <label style="padding-top:7px;color:#F44336;">
                            <strong><i class="fa fa-times-circle"></i> {{ $errors->first('keluhan') }}</strong>
                            </label>
                            @endif
                        </div>
                    </div>
                    <div id="link"></div>
                </fieldset>
                <div class="d-flex justify-content-between">
                    <a href="{{route('view-riwayat')}}" class="col-auto btn btn-secondary">Kembali</a>
                    <button type="submit" id="buat-antrian" class="col-auto btn btn-primary bg-primary-800">Buat Antrian</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('after-script')
<script type="text/javascript">
$(document).ready(function(){
    $('#link').hide().empty();
    $("select[name='poli']").change(function(){
        poli = $(this).val();
        $.ajax({
            url: "{{url('orangtua/reservasi/cek') }}"+"/"+poli
        }).done(function(data) {
            var tanggal = '';
            if (Array.isArray(data)) {
                $.each(data, function(i, item) {
                    let waktu = '';
                    let isDisabled='';

                    if (data[7].link) {
                        linkExternal = `<div class="form-group mb-3">
                                            <label class="control-label col-12">Link Reservasi External</label>
                                            <a href="${data[7].link}" target="_blank" class="col-auto btn btn-info">Buka reservasi ${data[7].klinik}</a>
                                        </div>`
                        $('#senyumin-features').hide();
                        $('#tanggal').empty();
                        $('#buat-antrian').hide();
                        $('#link').show();
                        $('#link').html(linkExternal);
                    } else if(data.indexOf(data[i]) !== 7) {
                        if(!data[i].day[0].sesi.length){
                            waktu = '<span class="d-block badge rounded bg-danger p-1 m-1">Tidak ada sesi klinik</span>'
                        }
                        $.each(data[i].day[0]['sesi'], function(j, sesi) {
                            waktu += `<p class="bg-info p-1 m-1">${sesi.sesi}: ${sesi.mulai} - ${sesi.selesai}</p>`
                        });
                        if(data[i].color==='bg-secondary'){
                            isDisabled = 'disabled'
                        }
                        tanggal += '<div class="col-6 col-md-4 col-lg-3 col-xl tanggal bg-opacity-10 mb-2" data-value="'+data[i].tanggal+'" '+isDisabled+'>'+
                            '<div class="header text-white '+data[i].color+' bg-opacity-75"><p class="p-2">'+data[i].hari+',<br>'+data[i].keterangan+'</p></div>'
                            +'<div style="margin:10px 0">'+waktu+'</div>'+
                        '</div>';
                        $('#link').hide().empty();
                        $('#senyumin-features').show();
                        $('#buat-antrian').show();
                        $('#tanggal').html(tanggal);
                    }
                });
            } else {
                $('#link').hide().empty();
                $('#senyumin-features').hide();
                $('#buat-antrian').hide();
                $('#tanggal').empty();
            }
        });
    });

    $(document).on("mouseenter", ".tanggal", function () {
        if($(this).is('[disabled]')) {
            $(this).css('cursor', 'not-allowed');
        }
    });
    $(document).on("click", ".tanggal", function () {
        if(!$(this).is('[disabled]')) {
            tanggal = $(this).data('value');
            $("input[name='tanggal']").val(tanggal)
            $('.header').removeClass('bg-opacity-100');
            $('.tanggal').removeClass('bg-secondary');
            $(this).addClass('bg-secondary');
            $(this).find('.header').addClass('bg-opacity-100');
            if ($(this).find('.header').hasClass('bg-secondary')) {
                $('#buat-antrian').hide();
            } else {
                $('#buat-antrian').show();
            }
        }
    });
});
</script>
@endpush
