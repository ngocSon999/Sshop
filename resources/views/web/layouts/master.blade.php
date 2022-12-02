<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    @yield('title')
    <link href="{{asset('/frontend/Eshopper/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('/frontend/Eshopper/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{asset('/frontend/Eshopper/css/prettyPhoto.css')}}" rel="stylesheet">
    <link href="{{asset('/frontend/Eshopper/css/price-range.css')}}" rel="stylesheet">
    <link href="{{asset('/frontend/Eshopper/css/animate.css')}}" rel="stylesheet">
    <link href="{{asset('/frontend/Eshopper/css/main.cs')}}s" rel="stylesheet">

    @yield('style')
</head>

<body>
@include('web.layouts.header')

@yield('content')

@include('web.layouts.footer')

@yield('js')
<script src="{{asset('/frontend/Eshopper/js/bootstrap.min.js')}}"></script>
<script src="{{asset('/frontend/Eshopper/js/jquery.scrollUp.min.js')}}"></script>
<script src="{{asset('/frontend/Eshopper/js/price-range.js')}}"></script>
<script src="{{asset('/frontend/Eshopper/js/jquery.prettyPhoto.js')}}"></script>
<script src="{{asset('/frontend/Eshopper/js/main.js')}}"></script>

</body>
</html>
