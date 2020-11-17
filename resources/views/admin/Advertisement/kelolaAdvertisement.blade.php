@extends('admin.template.master')

@section('title','Kelola Event')

@section('css_after')
<!-- DataTables -->
<link rel="stylesheet" href="{{asset('admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('breadcrumb')
<li class="breadcrumb-item active">Kelola Advertisement</li>
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Kelola Advertisement</h3>
                <div class="card-tools">
                    <!-- Buttons, labels, and many other things can be placed here! -->
                    <!-- Here is a label for example -->
                    <a href="{{route('admin_advertisement_tambah')}}" class="btn btn-sm btn-primary"><i class="fas fa-plus"></i> Tambah
                        Advertisement</a>


                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="tabeladvertisement" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Image</th>
                            <th>Desc</th>

                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data as $d)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td><img style="width: 100px;" src="{{asset($d->image)}}" alt=""></td>
                            <td>{{$d->desc}}</td>

                            <td class="text-center">
                                <button class="btn btn-sm btn-danger btn_delete_cat" name="hapus"><i class="fas fa-trash"></i></button>
                                <button class="btn btn-sm btn-info btn_edit_cat" name="edit"><i class="fas fa-pencil-alt"></i></button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Image</th>
                            <th>Desc</th>

                            <th>Action</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <!-- /.card-body -->
            <!-- <div id="advertisementloading" class="overlay dark">
                <i class="fas fa-2x fa-sync-alt fa-spin"></i>
            </div> -->
        </div>
        <!-- /.card -->
    </div>
</div>

@endsection

@section('js_after')
<!-- DataTables -->
<script src="{{asset('admin/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('admin/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<script src="{{asset('admin/plugins/sweetalert2/sweetalert2.all.min.js')}}"></script>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js" integrity="sha512-qTXRIMyZIFb8iQcfjXWCO8+M5Tbc38Qi5WzdPOYZHIlZpzBHG3L3by84BBBOiRGiEb7KKtAOAs5qYdUiZiQNNQ==" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/locale/id.min.js" integrity="sha512-he8U4ic6kf3kustvJfiERUpojM8barHoz0WYpAUDWQVn61efpm3aVAD8RWL8OloaDDzMZ1gZiubF9OSdYBqHfQ==" crossorigin="anonymous"></script> -->


@if(session('sukses_tambah'))
<script>
    swal("Good job!", "Data Berhasil Ditambah", "success");
</script>
@endif
@endsection