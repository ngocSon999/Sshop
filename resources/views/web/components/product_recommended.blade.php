<div class="recommended_items">
    <h2 class="title text-center">recommended items</h2>

    <div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            @foreach($productRecommended as $key=>$item)
                @if($key % 3 == 0)
                    <div class="item {{$key == 0 ? 'active' : ''}}">
                        @endif
                        <div class="col-sm-4">

                            <div class="product-image-wrapper">
                                <div class="single-products">
                                    <div class="productinfo text-center">
                                        <img src="{{$item->feature_image_path}}" alt=""/>
                                        <h2>đ {{number_format($item->price)}}</h2>
                                        <p>{{$item->name}}</p>
                                        <a href="{{route('web.productDetail',['id'=>$item->id])}}">Chi tiết sản phẩm</a>
                                        <div class="row">
                                                <a href="" class="btn btn-default add-to-cart"
                                                   data-url="{{route('web.getCart',['id'=>$item->id])}}">
                                                    <i class="fa fa-shopping-cart"></i>
                                                    Thêm vào giỏ hàng
                                                </a>
                                                <a href="" class="btn btn-default add-to-cart ">Mua ngay</a>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        @if($key % 3 == 2)
                    </div>
                @endif
            @endforeach
        </div>
        <a class="left recommended-item-control" href="#recommended-item-carousel"
           data-slide="prev">
            <i class="fa fa-angle-left"></i>
        </a>
        <a class="right recommended-item-control" href="#recommended-item-carousel"
           data-slide="next">
            <i class="fa fa-angle-right"></i>
        </a>
    </div>
</div>
