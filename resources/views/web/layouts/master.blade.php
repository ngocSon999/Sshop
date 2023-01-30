<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{csrf_token()}}">

    <link href="{{asset('/frontend/Eshopper/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('/frontend/Eshopper/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{asset('/frontend/Eshopper/css/prettyPhoto.css')}}" rel="stylesheet">
    <link href="{{asset('/frontend/Eshopper/css/price-range.css')}}" rel="stylesheet">
    <link href="{{asset('/frontend/Eshopper/css/animate.css')}}" rel="stylesheet">
    <link href="{{asset('/frontend/Eshopper/css/main.cs')}}s" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('/admins/layouts/header.css')}}">
    <link rel="stylesheet" href="{{asset('/frontend/vlite.css')}}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="{{asset('/frontend/vlite.js')}}"></script>
    <link rel="stylesheet" href="{{asset('frontend/css/style.css')}}">
    @yield('style')
</head>

<body style="position: relative">

<div id="headerTotal">
    @include('web.layouts.header')
</div>

@yield('content')

{{--@include('web.layouts.footer')--}}
<a class="crollUp" href="#"><i class="bi bi-arrow-up"></i></a>


<script>
    $(document).ready(function () {
        var scrollPage = document.querySelector('.crollUp');
        $(window).scroll(function () {
            if ($(this).scrollTop() > 100) {
                scrollPage.classList.add('active')
            } else {
                scrollPage.classList.remove('active')
            }
        })
        $(document).on('click', '.crollUp', function (e) {
            e.preventDefault()
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            })
        })
    })
</script>

<script src="{{asset('/frontend/js/bootstrap.min.js')}}"></script>
<script src="{{asset('/frontend/js/main.js')}}"></script>
@yield('js')

<div id="fb-root"></div>
<script>
    function playLoadVideo(index) {
        var index = index;
        console.log(index)
    }

    $(document).on('click', '.btn-show-video', function () {
        let video_id = $(this).data('video_id');
        $.ajax({
            type: 'POST',
            url: '{{route('admin.video.show_video')}}',
            dataType: 'JSON',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {video_id: video_id},
            success: function (data) {
                $('#exampleModalLabel').html(data.video_name);
                // var html='<div id="playerVideo" class="vlite-js" data-youtube-id="'+ data.video_link +'"></div>';
                $('.modal-body-show').html('<div id="playerVideo" class="vlite-js" data-youtube-id="' + data.video_link + '"></div>');
                console.log('ok')
                var playYT = new Vlitejs('#playerVideo', {
                    options: {
                        autoplay: false,
                        controls: true,
                        playPause: true,
                        progressBar: true,
                        time: true,
                        volume: true,
                        fullscreen: true,
                        poster: null,
                        bigPlay: true,
                        autoHide: false,
                        autoHideDelay: 3000,
                        playsinline: false,
                        loop: false,
                        muted: false,
                    },
                    onReady: (playYT) => {

                    },
                });

            },
            error: function () {

            }
        })
    })
</script>
</body>
</html>
