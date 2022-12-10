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


            <div class="shopper-informations">
                <div class="row">
                    @if(session('tb'))
                        <div class="alert alert-success">{{session('tb')}}</div>
                    @endif
                    <div class="col-sm-12 clearfix">
                        <div class="bill-to">
                            <p>Nhập thông tin nhận hàng</p>
                            <div class="form-one">
                                <form action="{{route('web.save_checkout')}}" method="post">
                                    @csrf
                                    <input name="name" type="text" placeholder="Họ và tên">
                                    @error('name')
                                    <p style="color: red; font-size: 14px">{{$message}}</p>
                                    @enderror

                                    <input name="email" type="text" placeholder="Email">
                                    @error('email')
                                    <p style="color: red; font-size: 14px">{{$message}}</p>
                                    @enderror

                                    <input name="phone" type="text" placeholder="Số điện thoại">
                                    @error('phone')
                                    <p style="color: red; font-size: 14px">{{$message}}</p>
                                    @enderror

                                    <input name="address" type="text" placeholder="Địa chỉ nhận hàng">
                                    @error('address')
                                    <p style="color: red; font-size: 14px">{{$message}}</p>
                                    @enderror

                                    <input name="note" type="text" placeholder="ghi chú ">
                                    @error('note')
                                    <p style="color: red; font-size: 14px">{{$message}}</p>
                                    @enderror

                                    <div style="margin-bottom: 20px; font-size: 20px">Chọn hình thức thanh toán</div>
                                    <div class="payment-options">
                                        <span>
                                            <label><input name="pay_method" value="1" type="checkbox"> Thanh toán bằng ATM</label>
                                        </span>
                                        <span>
                                            <label><input name="pay_method" value="2" type="checkbox">Thanh toán bằng thẻ ghi nợ</label>
                                        </span>
                                        <span>
                                            <label><input name="pay_method" value="3" type="checkbox"> Thanh toán bằng tiền mặt</label>
                                        </span>
                                        @error('pay_method')
                                        <p style="color: red; font-size: 14px">{{$message}}</p>
                                        @enderror
                                    </div>
                                    <button type="submit" class="btn btn-success btn-sm">Xác nhận</button>
                                    <button type="reset" class="btn btn-success btn-sm">Hủy</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="review-payment">
                <h2>Xem lại giỏ hàng</h2>
            </div>
            <!--xem lai giỏ hàng-->
            <div class="cart_wrapper">
                <div class="table-responsive cart_info">
                    <table class="table table-condensed ">
                        <thead>
                        <tr class="cart_menu">
                            <td>#</td>
                            <td class="image">Tên sản phẩm</td>
                            <td class="description"></td>
                            <td class="price">Đơn giá</td>
                            <td class="quantity">Số lượng</td>
                            <td class="total">Tổng tiền</td>
                            <td>Action</td>
                        </tr>
                        </thead>
                        <tbody>
                        @php
                            $total = 0;
                            $totalProduct = 0;
                        @endphp
                        @if(session()->get('carts'))
                            @foreach($carts as $id=> $cartItem)
                                @php
                                    $total += $cartItem['price'] * $cartItem['quantity'];
                                    $totalProduct += $cartItem['quantity'];
                                @endphp
                                <tr>
                                    <td data-id="{{$id}}">{{$id}}</td>

                                    <td class="cart_product">
                                        <a href="{{route('web.productDetail',['id'=>$id])}}"><img
                                                src="{{$cartItem['image_path']}}" width="100px" height="100px"
                                                alt=""></a>
                                    </td>

                                    <td class="cart_description">
                                        <h4>
                                            <a href="{{route('web.productDetail',['id'=>$id])}}">{{$cartItem['name']}}</a>
                                        </h4>
                                        <p></p>
                                    </td>

                                    <td class="cart_price">
                                        <p> {{number_format($cartItem['price'])}} đ</p>
                                    </td>

                                    <td class="cart_quantity">
                                        <input class="cart_quantity_input" type="number" name="quantity"
                                               value="{{$cartItem['quantity']}}" min="1" style="width: 80px">
                                    </td>

                                    <td class="cart_total">
                                        <p class="cart_total_price">{{number_format($cartItem['price'] * $cartItem['quantity'] )}}
                                            đ</p>
                                    </td>

                                    <td>
                                        <a class="btn btn-primary update-cart" href=""
                                           data-url="{{route('web.updateCart',['id'=>$id])}}">Cập nhật</a>
                                        <a class="btn btn-primary delete-cart"
                                           data-url_delete="{{route('web.deleteCart',['id'=>$id])}}" href="">Xóa</a>
                                    </td>
                                </tr>
                            @endforeach
                            <tr>
                                <td colspan="2">
                                    <table class="table table-condensed total-result">
                                        <tr>
                                            <td>Tổng tền sản phẩm:</td>
                                            <td>{{number_format($total)}} đ</td>
                                        </tr>
                                        <tr>
                                            <td>Thuế 5%:</td>
                                            <td>{{number_format($total * 0.05)}} đ</td>
                                        </tr>
                                        <tr class="shipping-cost">
                                            <td>Phí vận chuyển:</td>
                                            <td>Free</td>
                                        </tr>
                                        <tr>
                                            <td>Thành tiền:</td>
                                            <td><span>{{number_format($total + $total * 0.05)}} đ</span></td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        @else
                            <tr class="d-block text-center">Bạn chưa có sản phẩm nào trong giỏ hàng</tr>
                        @endif
                        </tbody>
                    </table>

                </div>
                @section('js')

                    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
                    <script src="{{asset('vendors/sweetalert2/sweetalert2@11.js')}}"></script>
                    <script>
                        function updateCart(e) {

                            e.preventDefault();
                            let urlRequest = $(this).data('url');
                            let quantity = $(this).parents('tr').find('input.cart_quantity_input').val();
                            $.ajax({
                                type: 'GET',
                                url: urlRequest,
                                data: {quantity: quantity},
                                success: function (data) {
                                    if (data.code === 200) {
                                        $('.cart_wrapper').html(data.cart_component);
                                        Swal.fire(
                                            'Cập nhật thành công',
                                        )
                                    }
                                },
                                error: function () {

                                }
                            })
                        }

                        function deleteCart(e) {
                            e.preventDefault();
                            let urldelete = $(this).data('url_delete');
                            Swal.fire({
                                title: 'Bạn muốn xóa sản phẩm này?',
                                text: "",
                                icon: 'warning',
                                showCancelButton: true,
                                confirmButtonColor: '#3085d6',
                                cancelButtonColor: '#d33',
                                confirmButtonText: 'OK'
                            }).then((result) => {
                                if (result.value) {
                                    $.ajax({
                                        type: 'GET',
                                        url: urldelete,
                                        success: function (data) {
                                            if (data.code === 200) {
                                                $('.cart_wrapper').html(data.cart_component);
                                                Swal.fire(
                                                    'Xóa thành công',
                                                    'success'
                                                )
                                            }
                                        },
                                        error: function () {

                                        }
                                    })

                                }
                            })
                        }

                        $(function () {
                            $('.update-cart').on('click', updateCart)
                            $('.delete-cart').on('click', deleteCart)
                        })
                    </script>
                @endsection

            </div>
        </div>
    </section> <!--/#cart_items-->
@endsection
