@extends('admin.template.master')

@section('title','Kelola Akun')

@section('css_after')
@endsection

@section('breadcrumb')
<li class="breadcrumb-item active">Kelola Akun</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row d-flex">
        <div class="col-md-4">
            <div class="card card-info" id="card_nama">
                <div class="card-header">
                    <h3 class="card-title">Kelola Nama</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <div class="card-body">
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-4 col-form-label">Username</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="nama" placeholder="Nama User" value="{{$data['akun'][0]->username}}">
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="button" class="btn btn-info" id="btn-simpan-nama">Simpan</button>
                        </div>
                        <!-- /.card-footer -->
                    </div>
                </div>
                <!-- /.card-body -->

                <!-- /.card-footer -->
            </div>
        </div>
        <div class="col-md-8">
            <div class="card card-info" id="card_pass">
                <div class="card-header">
                    <h3 class="card-title">Kelola Password</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <div class="card-body">
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-4 col-form-label">Password Lama</label>
                        <div class="col-sm-8">
                            <input type="password" class="form-control" id="pass1" placeholder="Password Lama">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputPassword3" class="col-sm-4 col-form-label">Password Baru</label>
                        <div class="col-sm-8">
                            <input type="password" class="form-control" id="pass2" placeholder="Password Baru">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputPassword3" class="col-sm-4 col-form-label">Konfirmasi Password Baru</label>
                        <div class="col-sm-8">
                            <input type="password" class="form-control" id="pass3" placeholder="Konfirmasi Password Baru">
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <button type="button" class="btn btn-info" id="btn-simpan-pass">Simpan</button>
                </div>
                <!-- /.card-footer -->
            </div>
        </div>
    </div>
</div>
@endsection

@section('js_after')
<script src="{{asset('admin/dist/js/axios.min.js')}}"></script>
<script src="{{asset('admin/plugins/sweetalert2/sweetalert2.all.min.js')}}"></script>
<script>
    const route = {
        ps: "{{route('admin_ubah_password')}}",
        nm: "{{route('admin_ubah_nama')}}",
    };
</script>
<script src="{{asset('admin/dist/js/pages/kelola_akun.js')}}"></script>
@endsection