@extends('admin.template.master')

@section('title','Edit Event')

@section('breadcrumb')
<li class="breadcrumb-item active"><a href="{{route('admin_kelola_event_index')}}">Kelola Event</a></li>
<li class="breadcrumb-item active">Edit Event</li>
@endsection

@section('content')
{{-- <div class="row"> --}}
<form action="{{route('admin_edit_event_post',['id'=>$data['event']->id])}}" method="POST"
    enctype="multipart/form-data">
    @csrf
    <div class="row">
        @if ($errors->any())
        <div class="col-md-12">
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
        @endif
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="form-group row mb-2">
                        <label for="title" class="col-sm-2 col-form-label">Nama Event <span
                                class="text-danger">*</span></label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="title" name="title" placeholder="Nama Event"
                                value="{{$data['event']->title}}">
                        </div>

                    </div>
                    <div class="row mb-2">
                        <div class="col-md-4">
                            <img id="blah" class="img-fluid" src="{{asset($data['event']->poster)}}"
                                alt="your image" />
                        </div>
                        <div class="col-md-8 d-flex">
                            <div class="form-group col-md-12 my-auto">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="poster" name="poster">
                                    <label class="custom-file-label"
                                        for="poster">{{substr($data['event']->title,0,10)}}.png</label>
                                    <small class="form-text text-muted">- Ukuran max 256KB</small>
                                    <small class="form-text text-muted">- Harus berupa gambar (format: jpg, jpeg, svg,
                                        png , dll)</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="kategori" class="col-sm-2 col-form-label">Kategori <span
                                class="text-danger">*</span></label>
                        <div class="col-sm-10">
                            <div class="form-group">
                                <select class="form-control select2" id="kategori" name="kategori" style="width: 100%;">
                                    @foreach ($data['cat'] as $k => $v)
                                    <option {{$k == $data['event']->categori_id ? 'selected="selected"' : ""}}
                                        value="{{$k}}">{{$v}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="date" class="col-sm-2 col-form-label">Tanggal Event <span
                                class="text-danger">*</span></label>
                        <div class="col-sm-10">
                            <div class="input-group date" id="date" data-target-input="nearest">
                                <input type="text" class="form-control datetimepicker-input" data-target="#date"
                                    name="date" required value="" />
                                <div class="input-group-append" data-target="#date" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title text-bold">Dekripsi Event <span class="text-danger">*</span></h3>
                </div>
                <div class="card-body">
                    <textarea class="textarea" name="desc"
                        style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">
                        {{$data['event']->desc}}
                    </textarea>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-2 mx-auto mb-3">
            <button class="btn btn-success btn-block" type="submit">Simpan</button>
        </div>
    </div>
</form>
@endsection

@section('css_after')
<link rel="stylesheet" href="{{asset('admin/plugins/select2/css/select2.min.css')}}">
<link rel="stylesheet" href="{{asset('admin/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
<link rel="stylesheet"
    href="{{asset('admin/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
<link rel="stylesheet" href="{{asset('admin/plugins/summernote/summernote-bs4.css')}}">

@endsection

@section('js_after')
<script src="{{asset('admin/plugins/select2/js/select2.full.min.js')}}"></script>
<script src="{{asset('admin/plugins/moment/moment.min.js')}}"></script>
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/locale/id.min.js"
    integrity="sha512-he8U4ic6kf3kustvJfiERUpojM8barHoz0WYpAUDWQVn61efpm3aVAD8RWL8OloaDDzMZ1gZiubF9OSdYBqHfQ=="
    crossorigin="anonymous"></script> --}}
<script src="{{asset('admin/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>
<script src="{{asset('admin/plugins/summernote/summernote-bs4.min.js')}}"></script>
<script>
    let dateDB = "{{$data['event']->date}}"
    let date = moment(dateDB,'YYYY-M-D HH:mm:ss').format("DD-MM-YYYY HH:mm");
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
            $('#blah').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]); // convert to base64 string
        }
    }

    $("#poster").change(function() {
        readURL(this);
    });

    $(document).ready(function(){
        $('.select2').select2({
            theme: 'bootstrap4'
        });
        $('#date').datetimepicker({
            allowInputToggle : true,
            format : 'DD-MM-YYYY HH:mm',
            icons: {
                time: 'fas fa-clock'
            },
        });
        $('input[name="date"]').val(date)
        $('.textarea').summernote({
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear']],
                ['fontname', ['fontname']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link']],
            ]
        })
    });
</script>
@endsection
