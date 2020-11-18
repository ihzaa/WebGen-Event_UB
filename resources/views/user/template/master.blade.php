<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{config('app.name')}} | @yield('title')</title>
    @yield('css_before')
    <link rel="stylesheet" href="{{asset('user/css/bootstrap.min.css')}}">
    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }

        /* 
        i {
            width: 34px;
            height: 30px;
        } */

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }
    </style>
    <link rel="stylesheet" href="{{asset('user/css/album.css')}}">
    @yield('css_after')
</head>

<body>
    @include('user.template.navbar')

    <main role="main">
        @yield('main')
    </main>

    @include('user.template.footer')

    @yield('js_before')
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="{{asset('user/js/bootstrap.bundle.min.js')}}"></script>
    @yield('js_after')
</body>

</html>