<div class="category-tab">

    <div class="col-sm-12">

        <ul class="nav nav-tabs">
            @foreach($categories as $key=>$category)
                <li class="{{$key == 0 ? 'active' : ''}}"><a href="#{{$category->slug}}"
                                                             data-toggle="tab">{{$category->name}}</a>
                </li>
            @endforeach
        </ul>
    </div>

    <div class="tab-content">
        @foreach($categories as $key=>$category)
            <div class="tab-pane fade {{$key == 0 ? 'active in' : ''}}" id="{{$category->slug}}">
                @foreach($category->categoryChildrent as $product)
                        <div class="col-sm-3">
                            <div class="product-image-wrapper">
                                <div class="single-products">
                                    <div class="productinfo text-center">
                                        <img src="{{$product->feature_image_path}}" alt=""/>
                                        <h2>đ {{number_format($product->price)}}</h2>
                                        <p>{{$product->name}}</p>
                                        <a href="{{route('web.productDetail',['id'=>$product->id])}}">Chi tiết sản phẩm</a>
                                        <div class="row">
                                            @if(Auth::user())
                                                <a href="" class="btn btn-default add-to-cart"
                                                   data-url="{{route('web.getCart',['id'=>$product->id])}}">
                                                    <i class="fa fa-shopping-cart"></i>
                                                    Thêm vào giỏ hàng
                                                </a>
                                                <a href="" class="btn btn-default add-to-cart ">Mua ngay</a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                @endforeach
            </div>
        @endforeach
    </div>
</div>
