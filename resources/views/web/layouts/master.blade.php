<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <meta property="og:url"           content="https://www.your-domain.com/your-page.html" />
    <meta property="og:type"          content="website" />
    <meta property="og:title"         content="Your Website Title" />
    <meta property="og:description"   content="Your description" />
    <meta property="og:image"         content="https://www.your-domain.com/path/image.jpg" />
    @yield('title')

    <link href="{{asset('/frontend/Eshopper/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('/frontend/Eshopper/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{asset('/frontend/Eshopper/css/prettyPhoto.css')}}" rel="stylesheet">
    <link href="{{asset('/frontend/Eshopper/css/price-range.css')}}" rel="stylesheet">
    <link href="{{asset('/frontend/Eshopper/css/animate.css')}}" rel="stylesheet">
    <link href="{{asset('/frontend/Eshopper/css/main.cs')}}s" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('/admins/layouts/header.css')}}">
    @yield('style')
</head>

<body>

<div id="headerTotal">
    @include('web.layouts.header')
</div>


@yield('content')

@include('web.layouts.footer')

@yield('js')
<script src="{{asset('/frontend/Eshopper/js/bootstrap.min.js')}}"></script>
<script src="{{asset('/frontend/Eshopper/js/jquery.scrollUp.min.js')}}"></script>
<script src="{{asset('/frontend/Eshopper/js/price-range.js')}}"></script>
<script src="{{asset('/frontend/Eshopper/js/jquery.prettyPhoto.js')}}"></script>
<script src="{{asset('/frontend/Eshopper/js/main.js')}}"></script>


<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v15.0" nonce="B9zVR5nF"></script>
</body>
</html>
