@extends('layout.master')

@section('title') reservasi @endsection
@section('content')
<div class="card">
    <div class="card-body text-center">
        <div class="card-title">
            <h4 class="mb-0">Reservasi</h4>
        </div>
        <hr>
        <div class="panel-body">
            <div class="col-12 my-3">
                @if ($reservasi->status == 'Reservasi')
                    <span class="badge bg-primary p-2">Status: Sudah {{$reservasi->status}}</span>
                @elseif ($reservasi->status == 'Batal Reservasi')
                    <span class="badge bg-secondary p-2">Reservasi Telah Dibatalkan</span>
                @else
                    <span class="badge bg-success p-2">Status: {{$reservasi->status}}</span>
                @endif
            </div>
            <div class="col-12">
                <p class="fw-bolder fs-1">{{ $reservasi->antrian }}</p>
            </div>
            <div class="col-12">
                <p class="fw-bold fs-5">{{ $reservasi->kode }}</p>
            </div>
            <hr>
            <div class="col-12 mb-2">
                <p>
                    Layanan Kesehatan:<br>
                    <span class="fw-bold fs-3">{{ strtoupper($reservasi->poli->poli) }}</span>
                </p>
            </div>
            <div class="col-12">
                <p>
                    Jadwal Pelayanan:<br>
                    <span class="fw-bold fs-4">{{\Carbon\Carbon::parse($reservasi->tanggal)->format('j F Y')}}</span><br>
                    @foreach ( $sesi as $item )
                        <span class="badge text-body fs-6 border border-dark m-1">Sesi {{$item->sesi}}: {{$item->mulai."-".$item->selesai}} </span>
                    @endforeach
                </p>
            </div>
            <div class="col-12 col-md-8 col-xl-6 col-xxl-5 alert alert-primary mx-auto my-3" role="alert">
                Harap datang sesuai dengan jadwal yang telah Anda pilih.
            </div>
            <hr>
        </div>
        <div class="d-flex justify-content-between">
            <a href="{{route('reservasi.riwayat')}}" class="col-auto btn btn-secondary">Kembali</a>
            @if ($reservasi->status == 'Reservasi' && \Carbon\Carbon::parse($reservasi->tanggal)->addHours(15) > \Carbon\Carbon::now())
                <button value="{{ $reservasi->id }}" id="batal-reservasi" class="btn btn-danger">Batalkan Reservasi</button>
            @endif
        </div>
    </div>
</div>
@endsection

@push('after-script')
<script  type="text/javascript"> 
    var tableData;

    $(document).ready(function () {
        $('#batal-reservasi').on( 'click', function () {
            Swal.fire({
                title: 'Harap Konfirmasi',
                text: "Apakah Anda yakin ingin membatalkan reservasi ini? Aksi ini tidak dapat dikembalikan.",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Lanjutkan'
            })
            .then((willDelete) => {
                if (willDelete.isConfirmed) {
                    $.ajax({
                        url: "{{ url('orangtua/reservasi/batal/'.$reservasi->id) }}",
                        method: 'get',
                        success: function(result){
                            console.log(result);
                            $('.card-body').load(window.location.href + " .card-body");;
                            Swal.fire(
                                'Resesrvasi Dibatalkan',
                                'Reservasi Anda berhasil dibatalkan',
                                'success'
                            );
                        }
                    });
                } else {
                    Swal.fire({
                        title: "Reservasi Anda aman",
                        showConfirmButton: false,
                        timer: 1200    
                    });
                }
            });
        });
    })
</script>
@endpush
