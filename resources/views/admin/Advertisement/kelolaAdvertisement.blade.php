@extends('admin.template.master')

@section('title','Kelola Advertisement')

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
                            <th>Description</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data as $d)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td><img style="width: 100px;" src="{{asset($d->image)}}" alt=""></td>
                            <td>
                                @php echo mb_strimwidth($d->desc, 0, 50, "...") @endphp</td>
                            <td class="text-center">
                                <!-- <form action="{{route('admin_advertisement_delete', ['id'=>$d->id])}}" method="POST" class="d-inline">
                                    @method('delete')
                                    @csrf
                                    <button class="btn btn-sm btn-danger btn_delete_cat" name="hapus" type="submit" onclick=" return ConfirmDelete() " class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                                </form> -->
                                <form action="{{route('admin_advertisement_delete',['id'=>$d->id])}}" method="POST" class="form-hapus d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger btn_delete_cat" name="hapus" type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                                </form>
                                <a href="{{route('admin_advertisement_edit', ['id'=>$d->id])}}" class="btn btn-sm btn-info btn_edit_cat" name="edit"><i class="fas fa-pencil-alt"></i></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Image</th>
                            <th>Description</th>
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
<script src="{{asset('admin/plugins/sweetalert2/sweetalert2.all.min.js')}}"></script>
<!-- <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> -->
<script src="{{asset('admin/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('admin/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>

<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js" integrity="sha512-qTXRIMyZIFb8iQcfjXWCO8+M5Tbc38Qi5WzdPOYZHIlZpzBHG3L3by84BBBOiRGiEb7KKtAOAs5qYdUiZiQNNQ==" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/locale/id.min.js" integrity="sha512-he8U4ic6kf3kustvJfiERUpojM8barHoz0WYpAUDWQVn61efpm3aVAD8RWL8OloaDDzMZ1gZiubF9OSdYBqHfQ==" crossorigin="anonymous"></script> -->

<script>
    $(function() {

        $('#tabeladvertisement').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": true,
            "responsive": true,
        });
    });
</script>
<script>
    // function ConfirmDelete() {
    // var x = confirm("Are you sure you want to delete?");
    // if (x)
    //     return true;
    // else
    //     return false;

    $(".form-hapus").on("submit", function(event) {
        event.preventDefault();
        Swal.fire({
            title: 'Yakin Ingin Menghapus?',
            icon: 'question',
            // text: 'test',
            // showDenyButton: true,
            showCancelButton: true,
            confirmButtonText: `Hapus!`,
            cancelButtonText: `Batal`,


        }).then((result) => {
            // console.log(result);
            /* Read more about isConfirmed, isDenied below */
            if (result.value) {
                // Swal.fire('Berhasil di hapus', '', 'success')
                // console.log($(this)[0]);
                $(this)[0].submit();
            }
        });
    });
</script>


@if(session('sukses_tambah'))
<script>
    swal("Good job!", "Data Berhasil Ditambah", "success");
</script>
@endif
@if(session('sukses_edit'))
<script>
    swal("Good job!", "Data Berhasil Diedit", "success");
</script>
@endif
@if(session('sukses_delete'))
<script>
    Swal.fire({
        icon: 'success',
        title: 'Berhasil',
        text: 'Selamat Data Berhasil dihapus',
        // footer: '<a href>Why do I have this issue?</a>'
    })
</script>
@endif
@endsection