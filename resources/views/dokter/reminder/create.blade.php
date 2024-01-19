@extends('layout.master')

@section('content')

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="text-center h3">Tambah Reminder</h6>
                    <form action="{{ route('reminder.store') }}" class="forms-sample" id="anak-store" method="post"
                          nctype="multipart/form-data" files=true>
                        @csrf

                        <div class="mb-3">
                            <label class="form-label">Nama Orangtua <span class="text-danger">*</span></label>
                            <select class="js-example-basic-single form-select select2" id="id_orangtua" name="id_orangtua" data-width="100%">
                                <option class="mb-2" value=" " >Pilih Orangtua</option>
                                @foreach(\App\Models\Orangtua::get() as $value => $key)
                                    <option value="{{$key->id}}">{{$key->nama}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Anak</label>
                            <select class="form-select select2" name="id_anak" id="id_anak" data-width="100%">
                                <option class="mb-2" value=" ">---Pilih Anak---</option>


                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Puskesmas <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="nama" name="puskesmas" autocomplete="off"
                                   placeholder="Masukkan Nama">
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Waktu pemeriksaan <span class="text-danger">*</span></label>
                            <input type="date" class="form-control" id="" name="waktu_pemeriksaan"
                                   autocomplete="off" placeholder="Masukkan tanggal pemeriksaan">
                        </div>

                        <div class="mb-3">
                            <label for="" class="form-label">Deskripsi <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="nama" name="description" autocomplete="off"
                                   placeholder="Masukkan Nama">
                        </div>


                        <div style="float: right">
                            <button type="submit" class="btn btn-primary me-2">Tambah</button>
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

            $('#id_orangtua').change(function () {
                let orangtua = $("#id_orangtua").val()
                $("#id_anak").children().remove();
                $("#id_anak").val('');
                $("#id_anak").append('<option value="">---Pilih Anak---</option>');
                $("#id_anak").prop('disabled', true)
                if (orangtua != '' && orangtua != null) {
                    $.ajax({
                        url: "{{url('')}}/data-anak/" + orangtua,
                        success: function (res) {
                            $("#id_anak").prop('disabled', false)
                            let tampilan_option = '';
                            $.each(res, function (index, anak) {
                                tampilan_option +=
                                    `<option value="${anak.id}">${anak.nama}</option>`
                            })
                            $("#id_anak").append(tampilan_option);
                        },
                    });
                }
            });
        });
     </script>
@endpush
