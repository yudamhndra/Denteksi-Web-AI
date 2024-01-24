@extends('layout.master')
@section('title') dashboard @endsection

@section('content')
<!-- <div class="row"> -->
    <div class="col-12 col-xl-12 mb-6">
        <div class="card shadow px-3 py-1">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 align-self-center">
                        <h2 class="mb-3 mb-md-0 text-left">Ingin melakukan </h2>
                        <h2 class="mb-3 mb-md-0 text-left">Pemeriksaan ?</h2>
                        <a type="button" href="{{route('view-anak.create')}}" class="btn btn-primary wd-350 mt-5 button">PERIKSA SEKARANG</a>
                        {{--<a type="button" href="#scan-camera" class="btn  wd-350 mt-3 btn-outline-info">PERIKSA DENGAN SCAN QR</a>--}}
                    </div>
                    <div class="col-md-6 text-center">
                        <img class="wd-300 ht-300" src="{{asset('assets/images/dokterscan.png')}}" alt="Senyumin" class="img-fluid">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Scan QR -->


    <div class="col-12 col-xl-12 mb-5">
        <div class="card shadow px-3 py-1" id="scan-camera">
            <div class="card-body p-6">
                <div class="text-center mb-4 row">
                    <h3>PERIKSA DENGAN SCAN QR</h3>
                </div>
                <div id="reader" width="200px" height="200px">
                    <!-- ... (Scan QR content) ... -->
                </div>
                <div class="input-group mt-4">
                    <input type="text" id="text_scan_input" class="form-control mt-3" placeholder="your link here" readonly/>
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary mt-3" type="button" onclick="browse_url()">Browse</button>
                    </div>
                </div>
            </div>
        </div>
    </div>


        <!-- <div class="col-12 col-xl-12 mb-4">
            <div class="card shadow px-3 py-1">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-baseline">
                        <h6 class="card-title">VIDEO REKOMENDASI</h6>
                    </div>
                    <div class="row">
                        {{-- @foreach($video as $video) --}}
                        <div class="col-md-7">
                        <iframe class="" width="240" height="180"
                        {{-- src="{{$video->link}}"> --}}
                            </iframe>
                        </div>
                        <div class="col-md-4">
                            {{-- <p>{{$video->judul}}</p> --}}
                        </div>
                        {{-- @endforeach --}}
                    </div>
                </div>
            </div>
        </div>
 -->



<!-- </div> -->

   {{--@include('orangtua.dashboard.artikel')--}}
<!-- </div> -->


@endsection
@push('after-script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js" integrity="sha512-ElRFoEQdI5Ht6kZvyzXhYG9NqjtkmlkfYk0wr6wHxU9JEHakS7UJZNeml5ALk+8IKlU6jDgMabC3vkumRokgJA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>




// <!-- selain riwayat pemeriksaan -->
<script>

    var idAnak = null;
    $(document).ready(function() {
        $('#pilih-anak').select2({
            placeholder: 'Pilih anak',
        });

        var chartTb = new Chart($('#chart-tb'), configChart('Tinggi Badan'));
        var chartBb = new Chart($('#chart-bb'), configChart('Berat Badan'));

        $('#pilih-anak').on('change', function() {
            idAnak = $(this).val();
            var ttl = $(this).find(':selected').data('t') + ', ' + $(this).find(':selected').data('tl');
            var jk = $(this).find(':selected').data('jk');
            var age = $(this).find(':selected').data('age');
            var imt = $(this).find(':selected').data('fs');
            var wfs = $(this).find(':selected').data('wfs');
            var ms = $(this).find(':selected').data('ms');
            var ts7 = $(this).find(':selected').data('ts7');
            var ts8 = $(this).find(':selected').data('ts8');

            wfs = wfs.split(' ')[0]
            var date = wfs.split('-').reverse().join('/')
            var hasil;

           if(imt>27){
            hasil = "Obesitas"
           }else if(imt<27 && imt>=25.1){
            hasil = "Gemuk"
           }else if(imt<25.1 && imt>=18.5){
            hasil = "Normal"
           }else if(imt<18.5 && imt>=17){
            hasil = "Kurus"
           }else{
            hasil =" Sangat Kurus"
           }

           if(ms==="minus"){
            mata = "Mata Minus"
           }else if(ms==="normal"){
            mata = "Mata Normal"
           }else{
            mata = "Buta Warna"
           }

           if(ts7==="ya" && ts8==="ya"){
            telinga= "Serumen 2"
           }else if(ts7==="ya" && ts8==="tidak"){
            telinga= "Serumen Kanan"
           }else if(ts7==="tidak" && ts8==="ya"){
            telinga="Serumen Kiri"
           }else{
            telinga = "Serumen Tidak Ada"
           }



            $('#row-data-anak').find('td').eq(0).html($(this).find(':selected').text());
            $('#row-data-anak').find('td').eq(1).html(jk);
            $('#row-data-anak').find('td').eq(2).html(ttl);
            $('#row-data-anak').find('td').eq(3).html(age + ' Tahun');
            $('#hasil-fisik').empty()
            $('#hasil-fisik').append(hasil)
            $('#hasil-mata').empty()
            $('#hasil-mata').append(mata)
            $('#hasil-telinga').empty()
            $('#hasil-telinga').append(telinga)
            $('.waktu-pemeriksaan').empty()
            $('.waktu-pemeriksaan').append(date)
            chart(chartTb,'tb');
            chart(chartBb,'bb');
        });

        $('.modal-artikel').on('click', function (event) {
            event.preventDefault();
            var judul = $(this).parents('.data-artikel').find('#judul').text()
            var link = $(this).parents('.data-artikel').find('#link').text()
            console.log(link)
            $('#modal-pdf').modal('show');

            $('#modal-pdf').on('shown.bs.modal', function (e) {
            $('#artikel-in-modal').attr('src', '/storage/artikel/'+link);
            $('#judul-artikel').empty(judul);
            $('#judul-artikel').append(judul);
            });
            $('#modal-pdf').on('hide.bs.modal', function (e) {
            $("#artikel-in-modal").attr('src','');
            });
            });
    });
    function chart(model,type) {
    $.ajax({
            type: "GET",
            url: "{{ route('viewDashboard.orangtua') }}"+"?type="+type+"&id="+idAnak,
            success: function (response) {
                if (response.type == 'tb') {
                    var labels = response.label.map(function (e) {
                        return e
                    });
                    var data = response.data.map(function (e) {
                        return e
                    });
                    model.data.labels = labels;
                    model.data.datasets[0].data = data;
                    model.update();
                } else if (response.type == 'bb') {
                    var labels = response.label.map(function (e) {
                        return e
                    });
                    var data = response.data.map(function (e) {
                        return e
                    });
                    model.data.labels = labels;
                    model.data.datasets[0].data = data;
                    model.update();
                }
            },
            error: function(xhr) {
                console.log(xhr.responseJSON);
            }
        });
    }

    function configChart(type){
        return config = {
            type: 'line',
            data: {
                datasets: [{
                    label: type,
                    backgroundColor: 'rgba(75, 192, 192, 1)',

                }]
            }
        };
    }
</script>




// <!-- QR SCAN -->


<script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>
<script>
var url_code;

function onScanSuccess(decodedText, decodedResult) {
  console.log(`Code matched = ${decodedText}`, decodedResult);
  document.getElementById("text_scan_input").value = decodedText;
  url_code = decodedText;
  window.open("http://127.0.0.1:8000/orangtua/anak/" + decodedText + "/editprofile", "_self")
}

function browse_url(){
      window.open(url_code, "_self")
}

function onScanFailure(error) {
}

let html5QrcodeScanner = new Html5QrcodeScanner(
  "reader",
  { fps: 10, qrbox: {width: 300, height: 300} },
  /* verbose= */ false);
html5QrcodeScanner.render(onScanSuccess, onScanFailure);

</script>

@endpush
