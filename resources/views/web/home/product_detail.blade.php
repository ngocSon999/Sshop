@extends('web.layouts.master')
@section('style')
@endsection
@section('content')
        <div class="product-details"><!--product-details-->
            <div class="col-sm-5">
                <div class="view-product">
                    <img src="{{$product->feature_image_path}}" alt="" />
                    <h3>ZOOM</h3>
                </div>
            </div>
            <div class="col-sm-7">
                <div class="product-information"><!--/product-information-->
                    <h2>{{$product->name}}</h2>
                    <p>{!!  $product->content !!}</p>
                    <span>
									<span>{{number_format($product->price)}} đ</span>
									<button type="button" class="btn btn-fefault cart">
										<i class="fa fa-shopping-cart"></i>
										Mua ngay
									</button>
								</span>
                    <p><b>Availability:</b> In Stock</p>
                    <p><b>Condition:</b> New</p>
                    <p><b>Brand:</b> E-SHOPPER</p>
                    <a href=""><img src="public/frontend/Eshoper/images/product-details/share.png" class="share img-responsive"  alt="" /></a>
                </div><!--/product-information-->
            </div>
        </div><!--/product-details-->

@endsection

@section('js')
@endsection
