@extends('web.layouts.master')
@section('content')

    <section id="cart_items">
        <div class="container">
            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="{{route('web.home.index')}}">Trang chủ</a></li>
                    <li class="active">Giỏ hàng của bạn</li>
                </ol>
            </div>
                    <!--list cart-->
            <div class="cart_wrapper">
                @include('web.components.show_cart')
            </div>
        </div>
    </section>

@endsection

