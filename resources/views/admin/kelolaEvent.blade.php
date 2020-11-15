@extends('admin.template.master')

@section('title','Kelola Event')

@section('css_after')
<!-- DataTables -->
<link rel="stylesheet" href="{{asset('admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('breadcrumb')
<li class="breadcrumb-item active">Kelola Event</li>
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Kategori Event</h3>
                <div class="card-tools">
                    <!-- Buttons, labels, and many other things can be placed here! -->
                    <!-- Here is a label for example -->
                    <button class="btn btn-sm btn-primary" id="btn_trigger_kategori"><i class="fas fa-plus"></i> Tambah
                        Katergori</button>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="tabelkategori" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Jumlah Event</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Jumlah Event</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <!-- /.card-body -->
            <div id="kategoriloading" class="overlay dark">
                <i class="fas fa-2x fa-sync-alt fa-spin"></i>
            </div>
        </div>
        <!-- /.card -->
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Event</h3>
                <div class="card-tools">
                    <!-- Buttons, labels, and many other things can be placed here! -->
                    <!-- Here is a label for example -->
                    <button class="btn btn-sm btn-primary" id="btn_trigger_event"><i class="fas fa-plus"></i> Tambah
                        Event</button>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="tabelevent" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Poster</th>
                            <th>Tanggal</th>
                            <th>Kategori</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Poster</th>
                            <th>Tanggal</th>
                            <th>Kategori</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <!-- /.card-body -->
            <div id="eventloading" class="overlay dark">
                <i class="fas fa-2x fa-sync-alt fa-spin"></i>
            </div>
        </div>
        <!-- /.card -->
    </div>
</div>

<div id="modal_kategori" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal_kategori_title">Title</h5>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="exampleInputEmail1">Nama Kategori</label>
                    <input type="text" class="form-control" id="nama_kategori_input"
                        placeholder="Masukkan Nama Kategori">
                    <span id="nama_kategori_input_error" class="error invalid-feedback">Form tidak boleh
                        kosong!</span>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-sm btn-success ml-auto" id="btn_simpan_modal_category"><i
                        class="fa fa-check"></i> Simpan</button>
            </div>
        </div>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"
    integrity="sha512-qTXRIMyZIFb8iQcfjXWCO8+M5Tbc38Qi5WzdPOYZHIlZpzBHG3L3by84BBBOiRGiEb7KKtAOAs5qYdUiZiQNNQ=="
    crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/locale/id.min.js"
    integrity="sha512-he8U4ic6kf3kustvJfiERUpojM8barHoz0WYpAUDWQVn61efpm3aVAD8RWL8OloaDDzMZ1gZiubF9OSdYBqHfQ=="
    crossorigin="anonymous"></script>
<script>
    const URL = {getCat : "{{route('admin_get_all_category_with_event_count')}}",
                insertCar : "{{route('admin_tambah_category')}}",
                editCat : "{{route('admin_edit_category',['id'=>'__asd'])}}",
                deleteCat : "{{route('admin_delete_category',['id'=>'__asd'])}}",
                getEvent : "{{route('admin_get_all_event')}}"
                }
</script>
<script src="{{asset('admin/dist/js/pages/kelolaEventCategory.js')}}"></script>
<script src="{{asset('admin/dist/js/pages/kelolaEventEvent.js')}}"></script>

@endsection
