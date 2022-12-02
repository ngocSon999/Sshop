
<div class="features_items">
    <h2 class="title text-center">Features Items</h2>
    @foreach($products as $product)
        <div class="col-sm-4">
            <div class="product-image-wrapper">
                <div class="single-products">
                    <div class="productinfo text-center">
                        <img src="{{$product->feature_image_path}}" alt=""/>
                        <h2>đ {{number_format($product->price)}}</h2>
                        <p>{!! $product->name !!}</p>
                        <a href="{{route('web.productDetail',['id'=>$product->id])}}">Chi tiết sản phẩm</a>
                        <div class="row">
                            <a href="" class="btn btn-default add-to-cart"
                               data-url="{{route('web.getCart',['id'=>$product->id])}}">
                                <i class="fa fa-shopping-cart"></i>
                                Thêm vào giỏ hàng
                            </a>
                            <a href="" class="btn btn-default add-to-cart ">Mua ngay</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

</div>
<div class="d-flex justify-content-end">{{$products->links()}}</div>
@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="{{asset('vendors/sweetalert2/sweetalert2@11.js')}}"></script>
    <script>
        function addToCart(e) {
            e.preventDefault();
            let urlRequest = $(this).data('url');
            Swal.fire({
                title:'Thêm sản phẩm vào giỏ hàng?',
                text: "",
                icon: '',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'OK'
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        type: 'GET',
                        url: urlRequest,
                        dataType: 'json',
                        success: function (data) {
                            if (data.code === 200) {
                                Swal.fire(
                                    '',
                                    'Thêm sản phẩm vào giỏ hàng thành công',
                                    'success'
                                )
                            }
                        },
                        error: function () {
                            Swal.fire(
                                '',
                                'Vui lòng đăng nhập',
                                'warning'
                            )
                        }
                    })
                }
            })
        }

        $(function () {
            $('.add-to-cart').on('click', addToCart)
        })
    </script>
@endsection
