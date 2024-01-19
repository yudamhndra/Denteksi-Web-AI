@extends('layout.master')
@section('content')

<div class="card">
    <div class="card-body">
        <div class="card-title">
            <h4 class="mb-0">Tambah Sesi Klinik</h4>
        </div>
        <hr />
        <div class="panel-body">
            <form class="form-horizontal form-validate-jquery" action="{{route('klinik.sesi.store', ['klinik' => $poliHari->poli_id, 'sesiHari' => $poliHari->id])}}" method="post" enctype="multipart/form-data" files=true>
                {{ csrf_field() }}
                <fieldset class="content-group">
                    <div class="form-group mb-3">
                        <label class="control-label">Sesi <span class="text-danger">*</span></label>
                        <select class="form-select" name="sesi">
                            <option selected disabled>Pilih sesi...</option>
                            @foreach ($namaSesi as $key => $value)
                            <option value="{{$value}}" {{
                                old('sesi') === $value ? 'selected' : ''
                            }}>{{$value}}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('sesi'))
                        <label style="padding-top:7px;color:#F44336;">
                            <strong><i class="fa fa-times-circle"></i> {{ $errors->first('sesi') }}</strong>
                        </label>
                        @endif
                    </div>
                    <div class="form-group mb-3">
                        <label class="control-label">Kode Layanan Kesehatan <span class="text-danger">*</span></label>
                        <input type="text" name="kode_poli" class="form-control" value="{{$poliHari->poli->kode}} - {{$poliHari->poli->poli}}" disabled>
                        @if ($errors->has('kode_poli'))
                        <label style="padding-top:7px;color:#F44336;">
                            <strong><i class="fa fa-times-circle"></i> {{ $errors->first('kode_poli') }}</strong>
                        </label>
                        @endif
                    </div>
                    <div class="form-group mb-3">
                        <label class="control-label">Waktu Mulai <span class="text-danger">*</span></label>
                        <select class="form-select" name="mulai">
                            <option selected disabled>Pilih waktu mulai...</option>
                            @foreach ($jamSesi as $key => $value)
                            <option value="{{$value['mulai']}}" {{
                                old('mulai') === $value['mulai'] ? 'selected' : ''
                            }}>{{$value['mulai']}}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('mulai'))
                        <label style="padding-top:7px;color:#F44336;">
                            <strong><i class="fa fa-times-circle"></i> {{ $errors->first('mulai') }}</strong>
                        </label>
                        @endif
                    </div>
                    <div class="form-group mb-3">
                        <label class="control-label">Waktu Selesai <span class="text-danger">*</span></label>
                        <select class="form-select" name="selesai">
                            <option selected disabled>Pilih waktu selesai...</option>
                            @foreach ($jamSesi as $key => $value)
                            <option value="{{$value['selesai']}}" {{
                                old('selesai') === $value['selesai'] ? 'selected' : ''
                            }}>{{$value['selesai']}}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('selesai'))
                        <label style="padding-top:7px;color:#F44336;">
                            <strong><i class="fa fa-times-circle"></i> {{ $errors->first('selesai') }}</strong>
                        </label>
                        @endif
                    </div>
                    <div class="form-group mb-3">
                        <label class="control-label">Jumlah Dokter <span class="text-danger">*</span></label>
                        <input type="number" name="jumlah_dokter" class="form-control" value="{{old('jumlah_dokter')}}" placeholder="Jumlah dokter">
                        @if ($errors->has('jumlah_dokter'))
                        <label style="padding-top:7px;color:#F44336;">
                            <strong><i class="fa fa-times-circle"></i> {{ $errors->first('jumlah_dokter') }}</strong>
                        </label>
                        @endif
                    </div>
                    <div class="form-group mb-3">
                        <label class="control-label">Dokter <span class="text-danger">*</span></label>
                        <select id="dokter" name="dokter[]" class="form-control multi-select" multiple="multiple">
                            @foreach(\App\Models\Dokter::get() as $value)
                            <option value="{{$value->id}}" {{
                                (collect(old('dokter'))->contains($value->id)) ? 'selected' : ''
                            }}>{{$value->nama}}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('dokter'))
                        <label style="padding-top:7px;color:#F44336;">
                            <strong><i class="fa fa-times-circle"></i> {{ $errors->first('dokter') }}</strong>
                        </label>
                        @endif
                    </div>
                </fieldset>
                <div class="d-flex justify-content-end">
                    <a href="{{route('klinik.sesi.index', $poliHari->poli_id)}}"type="button" class="col-auto btn btn-secondary me-3"> <i class="icon-arrow-left13"></i> Kembali</a>
                    <button type="submit" class="col-auto btn btn-primary bg-primary-800">Simpan <i class="icon-arrow-right14 position-right"></i></button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- /content area -->
@endsection


@push('after-script')

<script  type="text/javascript">
$(document).ready(function() {
    $('.multi-select').select2();
    $('.select2-search__field').replaceWith(
        '<input class="form-control select2-search__field" type="search" tabindex="0" autocomplete="off" autocorrect="off" autocapitalize="none" spellcheck="false" role="searchbox" aria-autocomplete="list" placeholder="Pilih dokter..." style="padding: 0.469rem 0.8rem;">'
    );
})
</script>
@endpush
