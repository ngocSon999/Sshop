<style>
    .cart_header {
        position: relative;
    }

    .cart-items {
        position: absolute;
        top: 100%;
        left: -142px;
        width: 200px;
        height: 200px;
        background-color: rgba(0, 0, 0, 0.5);
        z-index: 100;
        display: none;
        text-align: center;
        color: #fff3cd;
    }

    .cart_header:hover .cart-items {
        display: block;
    }


    .cart-productTotal {
        position: absolute;
        top: -4px;
        right: -21px;
        border: 1px solid;
        width: 20px;
        height: 20px;
        border-radius: 100%;
        color: red;
        text-align: center;
        font-size: 12px;
    }

</style>

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
                                src="{{asset('/frontend/Eshopper/images/home/logo.png')}}" alt=""/></a>
                    </div>
                </div>

                @php
                    if (session()->get('carts')){
                        $carts = session()->get('carts');
                        if (!empty($carts)){
                            $totalProduct = 0;
                        foreach ($carts as $cart){
                            $totalProduct += $cart['quantity'];
                        }
                        }
                    }

                @endphp
                <div class="col-sm-8">
                    <div class="shop-menu pull-right">
                        <ul class="nav navbar-nav">
                            @if(Auth::user())
                                <li><a href="#"><i class="fa fa-user"></i> profile</a></li>
                                <li><a href="{{route('web.showCart')}}"><i class="fa fa-shopping-cart"></i>
                                        Cart
                                        @if(!empty($totalProduct))
                                            <p class="cart-productTotal"> {{$totalProduct}} </p>
                                        @endif
                                    </a>
                                </li>
                                <li>
                                    <a href="{{route('web.logout')}}">Đăng xuất</a>
                                </li>
                            @else
                                <li class="cart_header">
                                    <a href="#"><i class="fa fa-shopping-cart"></i>Cart</a>
                                    <div class="cart-items">
                                        <img src="" alt="">
                                        <p>Chưa có sản phẩm nào</p>
                                    </div>
                                </li>
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
                            <li><a href="{{route('web.contact.index')}}">Contact</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="search_box pull-right">
                        <form action="" method="get">
                            <input name="keywords1" type="text" placeholder="Nhập từ tìm kiếm"/>
                            <button class="btn btn-success" type="submit">Tìm kiếm</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div><!--/header-bottom-->
</header><!--/header-->

