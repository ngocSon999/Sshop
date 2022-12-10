@extends('web.layouts.master')
@section('title')
    <title>Home page</title>
@endsection

@section('style')
    <link rel="stylesheet" href="{{asset('/frontend/home/home.css')}}">
    <style>
        .product-image-wrapper:hover {
            transform: scale(1.05);
            transition: all linear 0.3s;
        }
    </style>
@endsection
@section('content')
    <section>
        <div class="container">
            <div class="row">
                <div class="col-sm-3">
                    <div class="left-sidebar">
                        <h2>Category</h2>
                        <div class="panel-group category-products" id="accordian"><!--category-product-->
                            @foreach($categories as $category)
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <a data-toggle="collapse" data-parent="#accordian"
                                               href="#mens_{{$category->id}}">
                                                @if($category->categoryChildrent->count())
                                                    <span class="badge pull-right"><i class="fa fa-plus"></i></span>
                                                @endif
                                                {{$category->name}}
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="mens_{{$category->id}}" class="panel-collapse collapse">
                                        <div class="panel-body">
                                            @foreach($category->categoryChildrent as $categoryChildrent)
                                                <ul>
                                                    <li>
                                                        <a href="{{route('web.categoryProduct',['slug'=>$categoryChildrent->slug, 'id'=>$categoryChildrent->id])}}">- {{$categoryChildrent->name}}</a>
                                                    </li>
                                                </ul>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div><!--/category-products-->
                    </div>
                </div>

                <div class="col-sm-9 padding-right">
                    <!--features_items-->
                    <div class="row">

                        @foreach($products as $product)
                            <div class="col-sm-4">
                                <div class="product-image-wrapper">
                                    <div class="single-products">
                                        <div class="productinfo text-center">
                                            <a href="{{route('web.productDetail',['id'=>$product->id])}}">
                                                <img src="{{$product->feature_image_path}}" alt=""/>
                                                <h2>đ {{number_format($product->price)}}</h2>
                                                <p>{!! $product->name !!}</p>
                                            </a>
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
                    <div class="row">{{$products->links()}}</div>
                    <!--features_items-->
                </div>
            </div>
        </div>
    </section>
@endsection
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
