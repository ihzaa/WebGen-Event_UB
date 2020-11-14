@extends('user.template.master')

@section('title','Home')
@section('css_after')
<link rel="stylesheet" href="{{asset('user/css/select2.min.css')}}">
<style>
    .select2 {
        width: 100% !important;
    }
</style>
@endsection

@section('main')
<section class="jumbotron text-center">
    <div class="container">
        <h1>Album example</h1>
        <p class="lead text-muted">Something short and leading about the collection below—its contents, the
            creator, etc. Make it short and sweet, but not too short so folks don’t simply skip over it
            entirely.</p>
        <div class="col-md-12">
            <div class="form-group pt-2">
                <label for="seachByCat">Cari Berdasarkan Kategori</label>
                <select class="form-control" id="seachByCat">
                    <option>Semua</option>
                </select>
            </div>
        </div>
    </div>
</section>

<div class="album py-5 bg-light">
    <div class="container">

        <div class="row">
            <div class="col-md-4">
                <div class="card mb-4 shadow-sm">
                    <img class="img-responsive" src="{{asset('user/img/breakfast.png')}}"
                        style="object-fit: cover !important;" alt="">
                    <div class="card-body">
                        <p class="card-text">This is a wider card with supporting text below as a natural
                            lead-in to additional content. This content is a little bit longer.</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="btn-group">
                                <button type="button" class="btn btn-sm btn-outline-secondary">Detail</button>
                            </div>
                            <small class="text-muted">
                                <i class="far fa-calendar-alt"></i>
                                ini tgl
                            </small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js_after')
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.1/css/all.css"
    integrity="sha384-vp86vTRFVJgpjF9jiIGPEEqYqlDwgyBgEF109VFjmqGmIY/Y4HV4d3Gp2irVfcrp" crossorigin="anonymous">
<script src="{{asset('user/js/select2.min.js')}}"></script>
<script src="{{asset('user/js/home.js')}}"></script>
@endsection
