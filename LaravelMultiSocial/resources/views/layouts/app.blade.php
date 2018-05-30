<!DOCTYPE html>

<html lang="{{ app()->getLocale() }}">

<head>

    <meta charset="utf-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1">



    <!-- CSRF Token -->

    <meta name="csrf-token" content="{{ csrf_token() }}">



    <title>{{ config('app.name', 'Laravel') }}</title>



    <!-- Styles -->
    {{--<link rel="stylesheet" src="{{asset('css/bootstrap.css')}}">--}}
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-glyphicons.css" rel="stylesheet">
    {{--<link href="{{ asset('css/app.css') }}" rel="stylesheet">--}}
    <script src="sa/jquery/jquery.js"></script>
    <script src="sa/js/bootstrap.js"></script>

    <style media="screen">
        .nav1 .navbar-brand {
            height: 40px;
            padding: 5px;
            width: auto;
        }

        .nav1 .nav >li >a {
            padding-top: 15px;
            padding-bottom: 10px;

        }

    </style>
    @yield('style')
</head>

<body>

@include('inc.header')






    @yield('content')

<!-- Scripts -->





@include('inc.footer')

<!-- jQuery -->
{{--<script src="sa/jquery/jquery.js"></script>--}}
<!-- Bootstrap Core JavaScript -->

@yield('script')


</body>

</html>
