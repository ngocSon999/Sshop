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
        @foreach($carts as $id=> $cartItem)
            @php
                $total += $cartItem['price'] * $cartItem['quantity'];
                $totalProduct += $cartItem['quantity'];
            @endphp
            <tr>
                <td data-id="{{$id}}">{{$id}}</td>

                <td class="cart_product">
                    <a href="{{route('web.productDetail',['id'=>$id])}}"><img src="{{$cartItem['image_path']}}" width="100px" height="100px" alt=""></a>
                </td>

                <td class="cart_description">
                    <h4><a href="{{route('web.productDetail',['id'=>$id])}}">{{$cartItem['name']}}</a></h4>
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
                    <p class="cart_total_price">{{number_format($cartItem['price'] * $cartItem['quantity'] )}} đ</p>
                </td>

                <td>
                    <a  class="btn btn-primary update-cart" href=""  data-url="{{route('web.updateCart',['id'=>$id])}}" >Cập nhật</a>
                    <a  class="btn btn-primary delete-cart" data-url_delete="{{route('web.deleteCart',['id'=>$id])}}"  href="" >Xóa</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <div class="row justify-content-center">
        <h3 class="d-block text-center">@if(!empty($total)) Tổng số sản phẩm là: {{$totalProduct}} - Tổng tiền giỏ hàng: {{number_format($total)}} đ @else Chưa có sản phẩm nào @endif</h3>
    </div>
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
                    if(data.code === 200){
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
                        success: function (data){
                            if(data.code === 200){
                                $('.cart_wrapper').html(data.cart_component);
                                Swal.fire(
                                    'Xóa thành công',
                                    'success'
                                )
                            }
                        },
                        error: function (){

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
