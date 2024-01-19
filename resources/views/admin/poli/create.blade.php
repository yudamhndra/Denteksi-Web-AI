@extends('layout.master')
@section('content')

<div class="card">
    <div class="card-body">
        <div class="card-title">
            <h4 class="mb-0">Tambah Data Layanan Kesehatan</h4>
        </div>
        <hr />
        <div class="panel-body">
            <form class="form-horizontal form-validate-jquery" action="{{route('klinik.store')}}" method="post" enctype="multipart/form-data" files=true>
                {{ csrf_field() }}
                <fieldset class="content-group">
                    <div class="form-group mb-3">
                        <label class="control-label">Layanan Kesehatan <span class="text-danger">*</span></label>
                        <input type="text" name="poli" class="form-control" value="{{old('poli')}}">
                        @if ($errors->has('poli'))
                        <label style="padding-top:7px;color:#F44336;">
                            <strong><i class="fa fa-times-circle"></i> {{ $errors->first('poli') }}</strong>
                        </label>
                        @endif
                    </div>
                    <div class="form-group mb-3">
                        <label class="control-label">Kode Layanan Kesehatan <span class="text-danger">*</span></label>
                        <input type="text" name="kode_poli" class="form-control" value="{{old('kode_poli')}}">
                        @if ($errors->has('kode_poli'))
                        <label style="padding-top:7px;color:#F44336;">
                            <strong><i class="fa fa-times-circle"></i> {{ $errors->first('kode_poli') }}</strong>
                        </label>
                        @endif
                    </div>
                    <div class="form-group mb-3">
                        <label class="control-label">Waktu Pemeriksaan <span class="text-danger">*</span></label>
                        <input type="number" name="waktu" id="waktu" min="1" class="form-control" value="{{old('waktu')}}">
                        @if ($errors->has('waktu'))
                        <label style="padding-top:7px;color:#F44336;">
                            <strong><i class="fa fa-times-circle"></i> {{ $errors->first('waktu') }}</strong>
                        </label>
                        @endif
                    </div>
                    <div id="url-switch" class="form-group d-flex mb-5">
                        <label class="control-label" for="switchHaveURL">URL Registrasi External:</label>
                        <div class="form-check form-switch ms-3">
                            <input type="checkbox" class="form-check-input" id="switchHaveURL" name="haveRegUrl" value="{{ old('haveRegUrl') ?? 'false' }}">
                        </div>
                    </div>
                    <div id="url-reg-external" class="form-group mb-5">
                        <label class="control-label">Link URL Registrasi <span class="text-danger">*</span></label>
                        <input type="url" name="url_external" id="url_external" class="form-control" value="{{old('url_external')}}" placeholder="https://">
                        @if ($errors->has('url_external'))
                        <label style="padding-top:7px;color:#F44336;">
                            <strong><i class="fa fa-times-circle"></i> {{ $errors->first('url_external') }}</strong>
                        </label>
                        @endif
                    </div>
                </fieldset>
                <div class="d-flex justify-content-end">
                    <a href="{{route('klinik.index')}}"type="button" class="col-auto btn btn-secondary me-3"> <i class="icon-arrow-left13"></i> Kembali</a>
                    <button type="submit" class="col-auto btn btn-primary bg-primary-800">Simpan <i class="icon-arrow-right14 position-right"></i></button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- /content area -->
@endsection

@push('after-script')
<script type="text/javascript">
    $(document).ready(function () {
        $('#url-reg-external').hide();
        if ($('#switchHaveURL').val() === 'true') {
            $(this).val(true);
            $('#url-switch').addClass('mb-3');
            $('#url-switch').removeClass('mb-5');
            $('#switchHaveURL').prop('checked', true);
            $('#url-reg-external').show();
        } else {
            $(this).val(false);
        }
        $('#switchHaveURL').on('change', function () {
            if ($(this).is(':checked')) {
                $(this).val(true);
                $('#url-switch').addClass('mb-3');
                $('#url-switch').removeClass('mb-5');
                $('#url-reg-external').show();
                $('#url_external').val('https://');
            } else {
                $(this).val(false);
                $('#url-switch').addClass('mb-5');
                $('#url-switch').removeClass('mb-3');
                $('#url-reg-external').hide();
            }
        });
    });
</script>
@endpush