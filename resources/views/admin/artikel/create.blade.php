@extends('layout.master')

@section('title') Tambah Data Artikel @endsection
@section('content')

<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h6 class="text-center h3">Tambah Artikel</h6>
                <form action="{{ route('artikel.store') }}" class="forms-sample"  method="post"
                enctype="multipart/form-data" files=true>
                    @csrf
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Judul</label>
                        <input type="text"  name="judul" class="form-control"
                        placeholder="">

                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Gambar</label>
                        <input type="file" class="form-control" name="gambar"  placeholder="masukkan gambar">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Artikel</label>
                        <input type="file"  class="form-control " name="artikel" placeholder="masukkan artikel">

                    </div>
                    <div style="float: right">
                    <button type="submit" class="btn btn-primary me-2">Tambah</button>
                    <button class="btn btn-secondary">Batal</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection



