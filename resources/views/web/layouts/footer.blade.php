    <link href="https://cdn.jsdelivr.net/npm/vlitejs@4/dist/vlite.css" rel="stylesheet" crossorigin />
<footer id="footer"><!--Footer-->
    <div class="footer-top">
        <div class="container">
            <div class="row">
                <div class="col-sm-2">
                    <div class="companyinfo">
                        <h2><span>e</span>-shopper</h2>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit,sed do eiusmod tempor</p>
                    </div>
                </div>
                <div class="col-sm-7">
                    <div class="row">
                        @if(!empty($videos))
                            @foreach($videos as $video)
                                <div class="col-sm-4">
                                    <div class="video-gallery text-center">
                                        <iframe onmouseenter="playLoadVideo(this.id)" class="hoverPlay" data-index="{{$video->id}}" id="{{$video->id}}" width="100%" height="200"
                                                src="https://www.youtube.com/embed/{{$video->video_link}}" title="YouTube video player"
                                                frameborder="1" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                                allowfullscreen>
                                        </iframe>

                                        <p>{{$video->video_name}}</p>
                                        <h2>{{$video->created_at}}</h2>
                                        <button type="button" data-toggle="modal" data-target="#show_video"
                                                data-video_id="{{$video->id}}" class="btn btn-primary btn-sm btn-show-video">Xem video</button>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="address">
                        <img src="{{asset('/frontend/Eshopper/images/home/map.png')}}" alt="" />
                        <p>555 Hà nội - Việt Nam</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="show_video" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">title video</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body modal-body-show">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-widget">
        <div class="container">
            <div class="row">
                <div class="col-sm-2">
                    <div class="single-widget">
                        <h2>Service</h2>
                        <ul class="nav nav-pills nav-stacked">
                            <li><a href="#">Online Help</a></li>
                            <li><a href="#">Contact Us</a></li>
                            <li><a href="#">Order Status</a></li>
                            <li><a href="#">Change Location</a></li>
                            <li><a href="#">FAQ’s</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="single-widget">
                        <h2>Quock Shop</h2>
                        <ul class="nav nav-pills nav-stacked">
                            <li><a href="#">T-Shirt</a></li>
                            <li><a href="#">Mens</a></li>
                            <li><a href="#">Womens</a></li>
                            <li><a href="#">Gift Cards</a></li>
                            <li><a href="#">Shoes</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="single-widget">
                        <h2>Policies</h2>
                        <ul class="nav nav-pills nav-stacked">
                            <li><a href="#">Terms of Use</a></li>
                            <li><a href="#">Privecy Policy</a></li>
                            <li><a href="#">Refund Policy</a></li>
                            <li><a href="#">Billing System</a></li>
                            <li><a href="#">Ticket System</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="single-widget">
                        <h2>About Shopper</h2>
                        <ul class="nav nav-pills nav-stacked">
                            <li><a href="#">Company Information</a></li>
                            <li><a href="#">Careers</a></li>
                            <li><a href="#">Store Location</a></li>
                            <li><a href="#">Affillate Program</a></li>
                            <li><a href="#">Copyright</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-3 col-sm-offset-1">
                    <div class="single-widget">
                        <h2>About Shopper</h2>
                        <form action="#" class="searchform">
                            <input type="text" placeholder="Your email address" />
                            <button type="submit" class="btn btn-default"><i class="fa fa-arrow-circle-o-right"></i></button>
                            <p>Get the most recent updates from <br />our site and be updated your self...</p>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="footer-bottom">
        <div class="container">
            <div class="row">
                <p class="pull-left">Copyright © 2013 E-SHOPPER Inc. All rights reserved.</p>
                <p class="pull-right">Designed by <span><a target="_blank" href="http://www.themeum.com">Themeum</a></span></p>
            </div>
        </div>
    </div>

</footer><!--/Footer-->



{{--<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/vlitejs@4/dist/vlite.css">--}}
<script src="https://cdn.jsdelivr.net/npm/vlitejs@4" crossorigin></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<script defer src="https://cdn.jsdelivr.net/npm/vlitejs@4"></script>
<script defer src="https://cdn.jsdelivr.net/npm/vlitejs@4/dist/providers/youtube.js"></script>


<script>
    function playLoadVideo(index){
        var index = index;
        console.log(index)
    }
    $(document).on('click','.btn-show-video',function (){
        let video_id = $(this).data('video_id');
        $.ajax({
            type:'POST',
            url:'{{route('admin.video.show_video')}}',
            dataType:'JSON',
            headers: {
                'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
            },
            data:{video_id:video_id},
            success:function (data){
                $('#exampleModalLabel').html(data.video_name);
                let html='<div id="player" class="vlite-js" data-youtube-id="'+ data.video_link +'"></div>';
                $('.modal-body-show').append(html);
                new Vlitejs('#player',{
                    options: {
                        autoplay: true,
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
                        providerParams: {},
                    },
                    onReady: function (player) {},
                    provider: 'html5',
                    plugins: [],
                    poster: '{{asset('frontend/Eshopper/images/no-cart.png')}}'

                });

            },
            error:function (){

            }
        })
    })
</script>
