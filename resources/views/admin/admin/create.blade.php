@extends('layout.master')

@section('content')
@if(session()->has('error'))
    <div class="alert alert-danger">
        {{ session()->get('error') }}
    </div>
@endif
<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h3 class="text-center">Tambah Admin</h3>
                <form action="{{ route('admin.store') }}" class="forms-sample p-3" id="admin-store" method="post" nctype="multipart/form-data" files=true >
                    @csrf
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Email address  <span class="text-danger">*</span></label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="mail@mail.com">
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <label for="password" class="form-label">Kata sandi <span class="text-danger">*</span></label>
                    <div class="input-group mb-3 ">
                        <input type="password"
                            class="form-control @error('password') is-invalid @enderror"
                            name="password" id="password" placeholder="masukkan kata sandi">
                        <div style="background: transparent" class="input-group-prepend ml-2">
                            <div style="padding:10px"class="input-group-text"><i style="width: 100%" class="fas fa-eye-slash "
                                    id="eye"></i></div>
                        </div>
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
        $('#eye').click(function () {

        if ($(this).hasClass('fa-eye-slash')) {
            $(this).removeClass('fa-eye-slash');
            $(this).addClass('fa-eye');
            $('#password').attr('type', 'text');

        } else {
            $(this).removeClass('fa-eye');
            $(this).addClass('fa-eye-slash');
            $('#password').attr('type', 'password');
        }
        });
	});
      


</script>
@endpush
