@extends('admin.template.master')

@section('title','Dashboard')
@section('css_after')
<style>
    .welcome-title h1 span {
        font-size: 25px;
        font-style: italic;
    }

    .garis {
        border-bottom: 5px solid grey;
        width: 700px;
    }

    .card-info {
        margin-top: 70px;
    }

    .info-box {
        height: 160px;
        width: 300px;
    }

    .info-box {
        transition: all .2s ease-in-out;
        /* display: block; */
        margin-left: auto;
        margin-right: auto;
        /* background-color: red; */
    }

    .info-box:hover {
        transform: scale(1.1);
    }

    .span {
        color: black;
    }

    .event {
        background-color: rgb(250, 126, 117);
    }

    .kategori {
        background-color: rgb(151, 248, 151);
    }

    .advertisement {
        background-color: rgb(142, 214, 247);
    }

    @media (min-width: 992px) {
        .info-box {
            object-position: 50% 50%;
        }
    }
</style>
@endsection

@section('content')
<div class="row justify-content-center welcome-title">
    <div class="col-md-10 col-lg-10">
        <h1 class="text-center">Selamat Datang Admin <br>
            Website Web-Gen, <span> Semoga Harimu Menyenangkan <i style="color: grey;"
                    class="fas fa-smile-wink"></i></span>
        </h1>
    </div>
    <div class="garis text-center"></div>
</div>
<div class="row justify-content-center card-info">
    <div class="col-12 col-sm-6 col-md-4 text-center justify-content-center">
        <a style="color: white; font-size:25px;" href="{{route('admin_kelola_event_index')}}">
            <div class="info-box event">
                <span style="width: 100px;" class="info-box-icon bg-danger elevation-1"><i
                        class="fas fa-calendar-week"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Event Count</span>
                    <span class="info-box-number">
                        {{$data['event']}}
                    </span>
                </div>
                <!-- /.info-box-content -->
            </div>
        </a>
        <!-- /.info-box -->
    </div>
    <div class="col-12 col-sm-6 col-md-4 text-center justify-content-center">
        <a href="{{route('admin_kelola_event_index')}}" style="color: white; font-size:25px;">
            <div class="info-box kategori">
                <span style="width: 100px;" class="info-box-icon bg-success elevation-1"><i
                        class="far fa-copyright"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Category Count</span>
                    <span class="info-box-number">
                        {{$data['category']}}
                    </span>
                </div>
                <!-- /.info-box-content -->
            </div>
        </a>
        <!-- /.info-box -->
    </div>
    <div class="col-12 col-sm-6 col-md-4 text-center justify-content-center">
        <a href="{{route('admin_advertisement_index')}}"
            style="color: white; font-size:25px; text-shadow:2px solid blue;">
            <div class="info-box advertisement">
                <span style="width: 100px;" class="info-box-icon bg-info elevation-1"><i
                        class="fab fa-blogger-b"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Advertisement</span>
                    <span class="info-box-number">
                        {{$data['ad']}}
                    </span>
                </div>
            </div>
        </a>
        <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
</div>
@endsection
