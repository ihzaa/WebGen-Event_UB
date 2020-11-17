@extends('admin.template.master')

@section('title','Kelola Event')

@section('css_after')
<!-- DataTables -->
<link rel="stylesheet" href="{{asset('admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
<!-- <meta name="csrf-token" content="{{ csrf_token() }}"> -->

<!-- summernote -->
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">

@endsection

@section('breadcrumb')
<li class="breadcrumb-item active">Tambah Advertisement</li>
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Tambah Advertisement</h3>
                <div class="card-tools">
                    <!-- Buttons, labels, and many other things can be placed here! -->
                    <!-- Here is a label for example -->
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <img id="blah" src="{{request()->is('*/kelolaAdvertisement/tambah*')?asset('images/default/picture.svg'):asset($data->image)}}" class="img-fluid" src="" alt="image advertisement" />
                    </div>
                    <div class="col-lg-8">
                        <!--  -->
                        <form action="{{route('admin_advertisement_store')}}" method="POST" role="form" id="tambahGambar" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    @csrf
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="imgInp" value={{old('image')}} required name="image" {{request()->is('*/kelolaAdvertisement/tambah*')?"required":""}} name="image">
                                        <label class="custom-file-label" id="labelnya_gambar" for="imgInp">{{request()->is('*/kelolaAdvertisement/tambah*')?"Image Advertisement":"image advertisement.jpg"}}</label>
                                        <small class="form-text text-muted">- Ukuran max 256KB</small>
                                        <small class="form-text text-muted">- Harus berupa gambar (format:
                                            jpg, jpeg, svg, jfif,
                                            png)</small>
                                    </div>
                                    @error('image')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-lg-12 col-md-12 justify-content-center">
                        <label for="summernote" style="font-size:18px;">Deskripsi</label>
                        @csrf
                        <textarea id="summernote" name="desc" class="form-control  background @error('desc') is-invalid @enderror">{{old('desc')}}</textarea>
                        @error('desc')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <div class="form-group d-flex flex-row-reverse">
                            <button type="submit" class="btn btn-lg btn-success mt-3 ml-3">Simpan</button>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
                </form>
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

<!-- summernote -->
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
    $(document).ready(function() {
        $('#summernote').summernote({
            placeholder: 'Tulis Deskripsi Iklan Disini',
            tabsize: 4,
            height: 190,
            minHeight: null,
            maxHeight: null,
            focus: true,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link']],
            ]
        });
    });
</script>

<script>
    $(document).ready(function() {
        bsCustomFileInput.init()
    })

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $('#blah').attr('src', e.target.result);
            }
            $("#labelnya_gambar").html(input.files[0].name);
            reader.readAsDataURL(input.files[0]); // convert to base64 string
        }
    }

    $("#imgInp").change(function() {
        readURL(this);
    });
</script>

@if('desc')
<script>
    $("#tambahGambar").form("show");
    // swal("PESAN", "sub pesan", "error");
</script>
@endif

@if($errors->any())
<script>
    $("#tambahGambar").form("show");
    // swal("PESAN", "sub pesan", "error");
</script>
@endif


@endsection