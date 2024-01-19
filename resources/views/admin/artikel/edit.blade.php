@extends('layout.master')

@section('title') Edit Artikel @endsection
@section('content')

<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h6 class="text-center h3">Edit Artikel</h6>
                <form action="{{ route('artikel.update',$artikel->id) }}" class="forms-sample" method="post" enctype="multipart/form-data" files=true >
                   
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label ">Judul</label>
                        <input type="text"  name="judul_edit" class="form-control" value="{{$artikel->judul}}"
                        placeholder="">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label ">Gambar</label>
                        <input type="file"  class="form-control " id="gambar_edit" name="gambar_edit"  placeholder="masukkan gambar">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label ">Artikel</label>
                        <input type="file"  class="form-control " name="artikel_edit" placeholder="masukkan gambar">
                    </div>
                    
                    <div style="float: right">
                    <button type="submit" class="btn btn-primary me-2">Simpan</button>
                    <a href="{{URL::previous()}}" type="button" class="btn btn-secondary">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection








