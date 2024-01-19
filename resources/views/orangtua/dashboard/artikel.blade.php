@extends('layout.master')
@section('title')

@section('content')


<div class="modal fade" id="modal-pdf" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="judul-artikel"></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
      </div>
      <div class="modal-body">
        <embed id="artikel-in-modal" src="" height="720" width="1080">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>
@foreach ($artikel as $artikel)
<div class="col-12 col-xl-12 mb-6">
        <div class="card shadow px-3 py-1">
            <div class="modal-header">
                <h5 class="modal-title" id="judul-artikel">{{$artikel->judul}}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
            </div>
            <div class="card-body">
            <div class="modal-body">
                <embed id="artikel-in-modal" src="" height="720" width="1080">
            </div>
                <div class="row">
                    <div class="col-md-6 align-self-center">

                    </div>
                    <div class="col-md-6 text-center">
                        <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endforeach

@endsection
