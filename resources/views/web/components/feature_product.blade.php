<div class="features_items">
    <h2 class="title text-center">Tất cả sản phẩm</h2>
    @foreach($products as $product)
        <div class="col-sm-4">
            <div class="product-image-wrapper">
                <div class="single-products">
                    <div class="productinfo text-center">
                        <a id="wishlist_productUrl_{{$product->id}}"
                           href="{{route('web.productDetail',['id'=>$product->id])}}">
                            <img src="{{$product->feature_image_path}}" alt=""/>
                            <h3>{{number_format($product->price)}} đ</h3>
                            <h2>{!! $product->name !!}</h2>
                            @php
                                $abc=0;
                                $quantitySolds= DB::table('oder_details')
                                    ->join('products','oder_details.product_id','=','products.id')
                                    ->where('products.id',$product->id)
                                    ->get();
                                foreach ($quantitySolds as $oder){
                                     $abc += $oder->quantity;
                                }
                            @endphp
                            <p>Đã bán: {{$abc}}</p>
                        </a>
                        <div class="row">
                            <a href="" class="btn btn-default add-to-cart addCart"
                               data-url="{{route('web.getCart',['id'=>$product->id])}}">
                                <i class="fa fa-shopping-cart"></i>
                                Thêm vào giỏ hàng
                            </a>
                            <button type="button" class="btn btn-default add-to-cart" data-toggle="modal"
                                    data-target="#xemnhanh"
                                    data-url-product="{{route('web.quick_view',['id'=>$product->id])}}">
                                Xem nhanh
                            </button>
                        </div>
                    </div>
                </div>
                <div class="choose">
                    <ul class="nav nav-pills nav-justified">
                        <input id="wishlist_name_{{$product->id}}" type="hidden" value="{{$product->name}}">
                        <input id="wishlist_price_{{$product->id}}" type="hidden" value="{{$product->price}}">
                        <input id="wishlist_image_{{$product->id}}" type="hidden"
                               value="{{$product->feature_image_path}}">
                        <li>

                            <button class="btn btn-xs btn-success btn_wishlist" id="{{$product->id}}"
                                    onclick="this.classList.toggle('btn-primary');add_wishlist(this.id)">
                                <i class="fa fa-plus-square"></i><span>Yêu thích</span></button>
                        </li>
                        <li><a href="#"><i class="fa fa-plus-square"></i>So sánh</a></li>
                    </ul>
                </div>
            </div>
        </div>
    @endforeach
</div>

<!-- Modal -->
<div class="modal fade" id="xemnhanh" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="product_quickview_name">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div style="display: flex">
                    <div style="width: 40%">
                        <p id="product_quickview_image"></p>
                    </div>
                    <div style="width: 60%">
                        <p>Mã sản phẩm:
                            <span id="product_quickview_id"></span>
                        </p>

                        <p id="product_quickview_price"></p>
                        <p id="product_quickview_category"></p>
                        <p id="product_quickview_content"></p>
                        <p id="product_quickview_idInput"></p>
                        <p>
                            Số lượng:
                            <input id="product-quantity" value="1" type="number">
                            <a style="margin-top: 8px" id="buyQuickView" href=""
                               class=" btn btn-default add-to-cart buyQuick"
                               data-url="{{route('web.quick_cart')}}">
                                <i class="fa fa-shopping-cart"></i>
                                Mua ngay
                            </a>
                        </p>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Đóng</button>
                <a href="{{route('web.showCart')}}" class="btn btn-primary">Đi tới giỏ hàng</a>
            </div>
        </div>
    </div>
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
                title: 'Thêm sản phẩm vào giỏ hàng?',
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
                                window.location.reload()
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
        //xem nhanh san pham
        function viewProduct() {
            let urlQuickView = $(this).data('url-product')
            $.ajax({
                type: 'GET',
                url: urlQuickView,
                dataType: 'json',
                success: function (data) {
                    console.log(data)
                    $('#product_quickview_image').html(data.product_image)
                    $('#product_quickview_id').html(data.product_id)
                    $('#product_quickview_name').html(data.product_name)
                    $('#product_quickview_price').html(data.product_price)
                    $('#product_quickview_category').html(data.product_category)
                    $('#product_quickview_content').html(data.product_content)
                    $('#product_quickview_idInput').html(data.product_input_id)
                },
                error: function () {

                }
            })
        }

        function addQuickCart(e) {
            e.preventDefault();
            let urlRequest = $(this).data('url');
            let idProduct = $('#idProduct').val();
            let productQuantity = $('#product-quantity').val();
            Swal.fire({
                title: 'Thêm sản phẩm vào giỏ hàng?',
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
                        data: {idProduct: idProduct, productQuantity: productQuantity},
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
            $('.add-to-cart.addCart').on('click', addToCart)
            $('.add-to-cart.buyQuick').on('click', addQuickCart)
            $('.add-to-cart').on('click', viewProduct)

        })
    </script>

    <!--Hiển thị sản phẩm yêu thích-->
    <script>
        function view() {
            if (localStorage.getItem('data') != null) {
                let data = JSON.parse(localStorage.getItem('data'))
                for (let i = 0; i < data.length; i++) {
                    console.log(data[i])
                    let name = data[i].name
                    let price = data[i].price
                    let image = data[i].image
                    let url = data[i].url
                    let htmls = '<div style="display:flex;margin-top: 10px;border-bottom:1px solid" >' +
                        '<div class="col-5">' +
                        '<img src="'+image+'" width="100%" height="200px" alt="">' +
                        '</div>' +
                        '<div class="col-7">'+
                        '<h3>'+name+'</h3>' +
                        '<p>'+price+'vnđ</p>' +
                        '<a class="" href="'+ url +'">Mua Ngay</a>' +
                        '</div>' +
                        '</div>'
                    $("#view_likeProduct").append(htmls)
                }
            }
        }
        view()
    </script>

    <!--nút thích sản phẩm-->
    <script>
        function add_wishlist(productId) {
            let id = productId;
            let name = document.getElementById('wishlist_name_' + id).value;
            let price = document.getElementById('wishlist_price_' + id).value;
            let image = document.getElementById('wishlist_image_' + id).value;
            let url = document.getElementById('wishlist_productUrl_' + id).href;
            let newItem = {
                'url': url,
                'id': id,
                'name': name,
                'price': price,
                'image': image,
            }

            if (localStorage.getItem('data') == null) {
                localStorage.setItem('data', '[]')
            }
            let old_data = JSON.parse(localStorage.getItem('data'))
            let maches = $.grep(old_data, function (obj) {
                return obj.id === id;
            })

            if (maches.length) {
                alert('Bạn đã thích sản phẩm này')
            } else {
                old_data.push(newItem)

                localStorage.setItem('data', JSON.stringify(old_data))
            }
        }
    </script>

@endsection

