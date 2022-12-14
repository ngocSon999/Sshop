<header id="header"><!--header-->
    <!--header_top-->
    <!--   <div class="header_top">
            <div class="container">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="contactinfo">
                            <ul class="nav nav-pills">
                                <li><a href="#"><i class="fa fa-phone"></i>{{getConfigSetting('phone')}}</a></li>
                                <li><a href="#"><i class="fa fa-envelope"></i>{{getConfigSetting('email')}}</a></li>

                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="social-icons pull-right">
                            <ul class="nav navbar-nav">
                                <li><a href="{{getConfigSetting('link_facebook')}}"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                                <li><a href="#"><i class="fa fa-dribbble"></i></a></li>
                                <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->
    <!--/header_top-->

    <div class="header-middle"><!--header-middle-->
        <div class="container">
            <div class="row">
                <div class="col-sm-4">
                    <div class="logo pull-left">
                        <a href="{{route('web.home.index')}}"><img
                                src="{{asset('/frontend/Eshopper/images/home/partner2.png')}}" alt=""/></a>
                    </div>
                </div>

                @php


                        if (session()->has('carts')){
                            $carts = session()->get('carts');
                            if (!empty($carts)){
                                $totalProduct = 0;
                                $totalPrice = 0;
                                foreach ($carts as $cart){
                                        $totalProduct += $cart['quantity'];
                                        $totalPrice += ($cart['quantity']* $cart['price']);
                                }
                            }
                        }
                @endphp
                <div class="col-sm-8">
                    <div class="shop-menu pull-right">
                        <ul class="nav navbar-nav">
                            @if(Auth::user())
                                <li class="profile-user toggle">
                                    <a href="#"><img src="{{Auth::user()->user_image_path}}"
                                                     width="22px"
                                                     height="22px"
                                                     alt="User Image"
                                                     style="border-radius: 100%">
                                        {{Auth::user()->name}}
                                    </a>
                                    <ul class="userLogout">
                                        <li><a href=""><i class="fa fa-suitcase"></i>Hồ sơ</a></li>
                                        <li><a href=""><i class="fa fa-cog"></i>Setting</a></li>
                                        <li><a href="{{route('web.logout')}}"><i class="fa fa-cog"></i>Đăng xuất</a>
                                        </li>
                                        <li>
                                            <button class="btn btn-success btn-sm">Đóng</button>
                                        </li>
                                    </ul>
                                </li>
                            @endif
                            <li class="cart_header">
                                <a href="{{route('web.showCart')}}"><i class="fa fa-shopping-cart"></i>Cart</a>


                                @if(!empty($totalProduct))
                                    <p class="cart-productTotal">{{$totalProduct}}</p>
                                    <div class="cart-items">
                                        @foreach(session()->get('carts') as $cart)
                                            <div>
                                                <img src="{{$cart['image_path']}}" width="50px" height="50px" alt="">
                                                <p>{{$cart['name']}} x {{$cart['quantity']}}  </p>
                                                <p>{{number_format($cart['price']*$cart['quantity'])}} đ</p>
                                            </div>
                                        @endforeach
                                        <div>Tổng sản phẩm: {{$totalProduct}}</div>

                                        <div>Tổng tiền: {{number_format($totalPrice)}} đ</div>

                                        <a class="btn btn-success" href="{{route('web.showCart')}}">Xem giỏ hàng</a>
                                    </div>
                                @else
                                    <p class="cart-productTotal">0</p>
                                    <div class="cart-items noCart">
                                        <img src="{{asset('/frontend/Eshopper/images/no-cart.png')}}" width="100%" alt="">
                                        <p>Chưa có sản phẩm nào trong giỏ hàng</p>
                                    </div>
                                @endif
                            </li>


                            @if(Auth::user())
                                <li>
                                    <a href="{{route('web.logout')}}">Đăng xuất</a>
                                </li>
                            @else
                                <li><a href="{{route('web.login.form_login')}}">Đăng nhập</a></li>
                                <li><a href="{{route('web.login.index')}}">Đăng ký</a></li>
                            @endif


                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div><!--/header-middle-->


    <div class="header-bottom"><!--header-bottom-->
        <div class="container">
            <div class="row">
                <div class="col-sm-9">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse"
                                data-target=".navbar-collapse">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                    </div>
                    <div class="mainmenu pull-left">
                        <ul class="nav navbar-nav collapse navbar-collapse">
                            <li><a href="{{route('web.home.index')}}" class="active">Trang chủ</a></li>
                            <!-- category tab -->
                            @foreach($categories as $key=>$category)
                                <li class="dropdown"><a href="#">{{$category->name}}<i class="fa fa-angle-down"></i></a>
                                    @include('web.components.menu_categoy',['categoryPrent'=>$category])
                                </li>
                            @endforeach
                            <li><a href="{{route('web.contact.index')}}">Liên hệ</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="search_box pull-right">
                        <form action="{{route('web.home.index')}}" method="get">
                            <input name="keywords1" type="text" placeholder="Nhập từ tìm kiếm"/>
                            <button class="btn btn-success" type="submit">Tìm kiếm</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div><!--/header-bottom-->
</header><!--/header-->


<script>
    let profileUser = document.querySelector('.profile-user.toggle')
    let userLogout = document.querySelector('.userLogout')
    profileUser.onclick = function (e) {
        console.log(e.target)
        userLogout.classList.toggle('open')
    }
</script>

