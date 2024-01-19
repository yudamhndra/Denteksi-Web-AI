@extends('layout.master')

@section('content')

<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title">Edit Admin</h6>
                <form action="{{ route('admin.update',$admin->id) }}" class="forms-sample" id="admin-update"
                    method="post" nctype="multipart/form-data" files=true>
                    <input type="hidden" id="id" value="{{$admin->id}}">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Email address</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Email"
                            value="{{$admin->email}}">
                    </div>
                    <div class="mb-3">
                        <div class="form-check form-switch mb-2">
                            <input type="checkbox" class="form-check-input" id="chk" type="reset" value="Reset">
                            <label class="form-check-label" id="labelchk" for="formSwitch1">Tidak mengubah Password</label>
                        </div>
                    </div>
                    <div id="ubah_password">

                        </div>
                        <div class="form-check mb-2" id="show_password">
                            <input type="checkbox" class="form-check-input" id="exampleCheck1">
                            <label class="form-check-label" for="exampleCheck1">
                                Show Password
                            </label>
                        </div>


                    <button type="submit" class="btn btn-primary me-2">Submit</button>
                    <a href="{{URL::previous()}}" type="button" class="btn btn-secondary">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('after-script')
<script type="text/javascript">
    $(document).ready(function () {
        $('#exampleCheck1').click(function () {
            if ($(this).is(':checked')) {
                $('#password').attr('type', 'text');
            } else {
                $('#password').attr('type', 'password');
            }
        });
        $('#show_password').hide();
        $('#chk').on('change', function () {
            if ($(this).is(':checked')) {
                var html = `<div class="mb-3" id="pss">
                            <label for="exampleInputPassword1" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" autocomplete="off"
                                value="" placeholder="Password">
                        </div>`
                $('#ubah_password').append(html);
                $('#show_password').show();
                
                $('#labelchk').text('Ubah Password');
              


            } else {

                $('#show_password').hide();
                $('#pss').remove();
                $('#labelchk').text('Tidak mengubah password');
            }
        });
    });

</script>



@endpush




