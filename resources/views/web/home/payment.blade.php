@extends('web.layouts.master')
@section('title')
    <title>Check-out</title>
@endsection
@section('content')
    <section id="cart_items">
        <div class="container">
            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="#">Home</a></li>
                    <li class="active">Thanh toán giỏ hàng</li>
                </ol>
            </div><!--/breadcrums-->



            <div class="review-payment">
                <h2>Xem lại giỏ hàng và xác nhận thanh toán</h2>
            </div>

            <div class="cart_wrapper">
                @include('web.components.show_cart')
            </div>
            <div style="margin-bottom: 20px; font-size: 20px">Chọn hình thức thanh toán</div>
            <div class="payment-options">
					<span>
						<label><input type="checkbox"> Thanh toán bằng ATM</label>
					</span>
                <span>
						<label><input type="checkbox">Thanh toán bằng thẻ ghi nợ</label>
					</span>
                <span>
						<label><input type="checkbox"> Thanh toán bằng tiền mặt</label>
					</span>
            </div>
        </div>
    </section> <!--/#cart_items-->
@endsection
