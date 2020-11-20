@extends('user.template.master')

@section('title','Home')
@section('css_after')
<link rel="stylesheet" href="{{asset('user/css/select2.min.css')}}">
<style>
    .select2 {
        width: 100% !important;
    }


    @media (min-width: 992px) {
        .advertisement {
            top: 180px;
            left: 950px;
            position: absolute;
            height: 300px;
            margin: auto;
            max-height: 200px;
            /* width: 200px; */
        }

    }

    .advertisement {
        object-position: center;
        margin: auto;
        overflow: hidden;
        /* max-height: 100px; */
    }

    .advertisement .card-text {
        font-size: 12px;
        color: grey;

    }

    .advertisement .card-title {
        font-size: 12px;
    }

    .iklan {
        background-color: rgba(0, 0, 0, .05);
        min-width: 350px;
        max-width: 350px;
        overflow: hidden;
        /* border: 1px solid grey; */
        /* box-shadow: 1px 1px 1px 1px grey; */

    }

    .iklan .card-title {
        color: black;
        font-size: 14px;
    }

    .iklan .card-text {
        font-size: 12px;
        color: grey;
    }

    .iklan img {
        width: 100%;
        height: auto;
        display: inline-block;
        min-height: 100px;
        max-height: 100px;
        object-fit: cover;
    }
</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/paginationjs/2.1.5/pagination.css" integrity="sha512-QmxybGIvkSI8+CGxkt5JAcGOKIzHDqBMs/hdemwisj4EeGLMXxCm9h8YgoCwIvndnuN1NdZxT4pdsesLXSaKaA==" crossorigin="anonymous" />
@endsection

@section('main')
<section class="jumbotron text-center">
    <div class="container">
        <h1>Album example</h1>
        <p class="lead text-muted">Something short and leading about the collection below—its contents, the
            creator, etc. Make it short and sweet, but not too short so folks don’t simply skip over it
            entirely.</p>
        <!-- advertisement -->
        <div class="d-flex justify-content-center">
            <a style="color: white; font-size:8px;" href="#">
                <div class="justify-content-center card iklan" style="width: 18rem;">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-5">
                                <img src="{{asset('assets/images/advertisement/5thumbnail.jfif')}}" class="img-fluid rounded float-left" alt="...">
                            </div>
                            <div class="col-md-7">
                                <h5 class="card-title text-left">Card title</h5>
                                <p class="card-text text-left">ld on the card title and make up the bulk of the card's content.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <!-- akhir advertisement -->
    </div>
    <div class="container">
        <div class="col-md-12">
            <div class="form-group pt-2">
                <label for="seachByCat">Cari Berdasarkan Kategori</label>
                <select class="form-control" id="seachByCat">
                    <option value="all">Semua</option>
                    @foreach ($data['cat'] as $k => $v)
                    <option value="{{$k}}">{{$v}}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>

</section>

<div class="album py-5 bg-light">
    <div class="container">
        <div class="row" id="data-container"></div>
        <div class="row">
            <div class="col-md-12 d-flex">
                <div id="pagination-container" class="mx-auto text-center"></div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js_after')
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.1/css/all.css" integrity="sha384-vp86vTRFVJgpjF9jiIGPEEqYqlDwgyBgEF109VFjmqGmIY/Y4HV4d3Gp2irVfcrp" crossorigin="anonymous">
<script src="{{asset('user/js/select2.min.js')}}"></script>
<script src="{{asset('user/js/home.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/paginationjs/2.1.5/pagination.min.js" integrity="sha512-1zzZ0ynR2KXnFskJ1C2s+7TIEewmkB2y+5o/+ahF7mwNj9n3PnzARpqalvtjSbUETwx6yuxP5AJXZCpnjEJkQw==" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js" integrity="sha512-qTXRIMyZIFb8iQcfjXWCO8+M5Tbc38Qi5WzdPOYZHIlZpzBHG3L3by84BBBOiRGiEb7KKtAOAs5qYdUiZiQNNQ==" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/locale/id.min.js" integrity="sha512-he8U4ic6kf3kustvJfiERUpojM8barHoz0WYpAUDWQVn61efpm3aVAD8RWL8OloaDDzMZ1gZiubF9OSdYBqHfQ==" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/lazyload@2.0.0-rc.2/lazyload.js"></script>
<script>
    const baseImgUrl = "{{asset('storage')}}";
    const URL = {
        allEvent: "{{route('user_get_all_event')}}",
        getEventByCat: "{{route('user_get_event_by_cat_id',['ahaha'])}}",
        getEventById: "{{route('user_get_event_by_id',['nungguin_ya?'])}}"
    }
</script>
<script src="{{asset('user/js/event.js')}}"></script>
@endsection