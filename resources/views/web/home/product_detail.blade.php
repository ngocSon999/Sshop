@extends('web.layouts.master')
@section('style')
    <link rel="stylesheet" href="{{asset('/frontend/productDetail/style_productDetail.css')}}">

@endsection
@section('content')
    <div class="col-sm-12 padding-right">
        <div class="product-details"><!--product-details-->
            <div class="col-sm-5">
                <div class="view-product">
                    <img style="transform: scale(1)" id="anh_chinh" src="{{$product->feature_image_path}}" alt=""/>
                    <h3 type="button" id="zoom_image">ZOOM</h3>
                </div>

                <div id="similar-product" class="carousel slide" data-ride="carousel">
                    <!-- Wrapper for slides -->
                    <div class="carousel-inner">
                        <div class="item active">
                            @foreach($product->images->take(4) as $key=> $productImage)
                                <img class=" show-anh-phu anh_phu_{{$productImage->id}}"
                                     onclick="showProductImage(this.id)" id="{{$productImage->id}}" width="100px"
                                     height="100px" src="{{$productImage->image_path}}" alt="">
                            @endforeach
                        </div>
                        <div class="item">
                            @foreach($product->images->skip(4)->take(4) as $key=> $productImage)
                                <img class=" show-anh-phu  anh_phu_{{$productImage->id}}"
                                     onclick="showProductImage(this.id)" id="{{$productImage->id}}" width="100px"
                                     height="100px" src="{{$productImage->image_path}}" alt="">
                            @endforeach
                        </div>
                    </div>

                    <!-- Controls -->
                    <a class="left item-control" href="#similar-product" data-slide="prev">
                        <i class="fa fa-angle-left"></i>
                    </a>
                    <a class="right item-control" href="#similar-product" data-slide="next">
                        <i class="fa fa-angle-right"></i>
                    </a>
                </div>
            </div>

            <div class="col-sm-7">
                <div class="product-information"><!--/product-information-->
                    <h2>{{$product->name}}</h2>
                    <span>
                    <span>{{number_format($product->price)}} ??</span>
                    <div class="row">
                        <div>
                            <p>S??? l?????ng: </p>
                            <p><input id="product-quantity" value="1" type="number"></p>
                        </div>
                        <a href="" class="btn btn-default add-to-cart addCart"
                           data-url="{{route('web.getCart',['id'=>$product->id])}}">
                        <i class="fa fa-shopping-cart"></i>
                        Th??m v??o gi??? h??ng
                        </a>
                        <a href="" class="btn btn-default add-to-cart ">Mua ngay</a>
                    </div>
                    </span>
                    <p><b>M?? s???n ph???m:</b> #{{$product->id}}</p>
                    <p><b>Danh m???c:</b>{{$product->category->name}}</p>
                    <p><b>T??nh tr???ng:</b> C??n h??ng</p>
                    <p><b>Th????ng hi???u:</b> ????? t??nh sau</p>

                    <div>
                        <h4>Tags<i class="fa fa-tag"></i></h4>
                        <ul class="tags-product">
                            @foreach($tags as $tag)
                                <li class=""><a
                                        href="{{route('web.product_tag',['slug'=>$tag->name])}}">{{$tag->name}}</a></li>
                            @endforeach
                        </ul>
                    </div>

                </div>

            </div>
        </div><!--/product-details-->

        <div class="category-tab shop-details-tab"><!--category-tab-->
            <div class="col-sm-12">
                <ul class="nav nav-tabs">
                    <li><a href="#details" data-toggle="tab">M?? t???</a></li>
                    <li><a href="#companyprofile" data-toggle="tab">Chi ti???t</a></li>
                    <li class="active"><a href="#reviews" data-toggle="tab">????nh gi??</a></li>
                </ul>
            </div>
            <div class="tab-content">
                <div class="tab-pane fade" id="details">
                    <div class="col-sm-3">
                        <div class="product-image-wrapper">
                            <div class="single-products">
                                <div class="productinfo text-center">
                                    <img src="" alt=""/>
                                    <h2>$56</h2>
                                    <p>Easy Polo Black Edition</p>
                                    <button type="button" class="btn btn-default add-to-cart"><i
                                            class="fa fa-shopping-cart"></i>Add to cart
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="product-image-wrapper">
                            <div class="single-products">
                                <div class="productinfo text-center">
                                    <img src="" alt=""/>
                                    <h2>$56</h2>
                                    <p>Easy Polo Black Edition</p>
                                    <button type="button" class="btn btn-default add-to-cart"><i
                                            class="fa fa-shopping-cart"></i>Add to cart
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="tab-pane fade" id="companyprofile">
                    <div class="row">
                        <div class="col-sm-7">{!! $product->content !!}</div>
                        <div class="col-sm-5">
                            <div class="product-image-wrapper">
                                <div class="single-products">
                                    <div class="productinfo text-center">
                                        <img src="{{$product->feature_image_path}}" alt=""/>
                                        <h2>{{number_format($product->price)}} ??</h2>
                                        <p>{{$product->name}}</p>
                                        <button type="button" class="btn btn-default add-to-cart addCart"
                                                data-url="{{route('web.getCart',['id'=>$product->id])}}"><i
                                                class="fa fa-shopping-cart"></i>Th??m v??o gi??? h??ng
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="tab-pane fade active in" id="reviews">

                    <div class="col-sm-12">
                        @if(Auth::user())
                            @if(Auth::user()->is_admin)
                                <ul>
                                    <li><a href=""><i class="fa fa-user"></i>Admin: {{Auth::user()->name}}</a></li>
                                    <li><a href=""><i class="fa fa-clock-o"></i>12:41 PM</a></li>
                                    <li><a href=""><i class="fa fa-calendar-o"></i>31 DEC 2014</a></li>
                                </ul>
                            @endif
                        @endif

                        @foreach($comments as $comment)
                            <div style="background-color: bisque; margin:4px 0" class="row">
                                <div class="col-sm-2">
                                    <img src="{{$comment->users->user_image_path}}" width="100px" height="100px" alt="">
                                </div>
                                <div class="col-sm-10">
                                    <div class="row">
                                        <p><b>@if($comment->users->is_admin)
                                                    @Admin:
                                                @endif{{$comment->users->name}}</b></p>
                                        <p>{{$comment->description}}</p>
                                        <p>{{$comment->content}}</p>
                                        <p><a class="btn btn-xs btn-default">Xem th??m</a></p>
                                        <p>
                                            <span>{{$comment->created_at}}</span>
                                            <span><a href="">Th??ch</a></span>
                                            <span><a href="">Ph???n h???i</a></span>
                                            <span>1<i class="fa-solid fa-thumbs-up"></i></span>
                                            @if(Auth::check())
                                                @if(Auth::id() == $comment->user_id)
                                                    <span><a type="button"
                                                             data-toggle="modal" data-target="#viewEditComment"
                                                             data-url="{{route('web.edit_comment',['id'=>$comment->id])}}"
                                                             class="user_edit_comment" href="">S???a</a></span>
                                                    <span>
                                                    <a onclick="return confirm('B???n mu???n x??a n???i dung n??y?')"
                                                       href="{{route('web.delete_comment',['id'=>$comment->id])}}">X??a</a>
                                                </span>
                                                @endif
                                            @endif
                                        </p>
                                    </div>
                                </div>
                            </div>

                            @foreach($comment->parentComment as $parentComment)
                                <div style="background-color: #99CC99; margin:4px 0 4px 40px;" class="row">
                                    <div class="col-sm-2">
                                        <img src="{{$parentComment->users->user_image_path}}" width="100px"
                                             height="100px" alt="">
                                    </div>
                                    <div class="col-sm-10">
                                        <div class="row">
                                            <p><b>@if($parentComment->users->is_admin)
                                                        @Admin:
                                                    @endif{{$parentComment->users->name}}</b></p>
                                            <p>{{$parentComment->description}}</p>
                                            <p>{{$parentComment->content}}</p>
                                            <p><a class="btn btn-xs btn-default">Xem th??m</a></p>
                                            <p>
                                                <span>{{$parentComment->created_at}}</span>
                                                <span><a href="">Th??ch</a></span>
                                                <span><a href="">Ph???n h???i</a></span>
                                                <span>1<i class="fa-solid fa-thumbs-up"></i></span>
                                                @if(Auth::check())
                                                    @if(Auth::id() == $parentComment->user_id)
                                                        <span><a type="button"
                                                                 data-toggle="modal" data-target="#viewEditComment"
                                                                 data-url="{{route('web.edit_comment',['id'=>$parentComment->id])}}"
                                                                 class="user_edit_comment" href="">S???a</a></span>
                                                        <span>
                                                    <a onclick="return confirm('B???n mu???n x??a n???i dung n??y?')"
                                                       href="{{route('web.delete_comment',['id'=>$comment->id])}}">X??a</a>
                                                </span>
                                                    @endif
                                                @endif
                                            </p>

                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endforeach
                        <p>????nh gi?? sao: </p>
                        <ul class="list-inline" title="Average Ranting">
                            @for($count = 1; $count <= 5; $count++)
                                @php
                                    if ($count <= $ratting){
                                        $color = 'color:#ffcc00';
                                    }else{
                                         $color = 'color:#ccc';
                                    }
                                @endphp
                                <li title="????nh gi?? sao"
                                    id="ratingProduct{{$count}}"
                                    data-index="{{$count}}"
                                    data-product_id="{{$product->id}}"
                                    data-ratting="{{$ratting}}"
                                    class="ratting"
                                    data-url="{{route('web.insert_ratting')}}"
                                    style="cursor:pointer;{{$color}}; font-size: 30px">
                                    &#9733;
                                </li>
                            @endfor

                        </ul>
                        @if(Auth::user())
                            <p><b>B??nh lu???n</b></p>
                            @if(session('tb'))
                                <div class="alert alert-success">{{session('tb')}}</div>
                            @endif
                            <form action="{{route('web.save_comment')}}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="">Nh???p ti??u ?????:</label>
                                    <input required maxlength="255" class="form-control" name="description"
                                           placeholder="Nh???p ti??u ?????"/>
                                </div>
                                <div>
                                    <label for="">Nh???p n???i dung:</label>
                                    <textarea required maxlength="255" name="contents"
                                              placeholder="Nh???p n???i dung"></textarea>
                                </div>
                                <input hidden name="product_id" value="{{$product->id}}">

                                <button type="submit" class="btn btn-default pull-right">
                                    G???i
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div><!--/category-tab-->
        <!--S???n ph???m g???i ?? xem nhanh-->
        @include('web.components.product_detail.product_recommend')
    </div>
    <!-- Modal comment-->
    @include('web.components.product_detail.modal_edit_comment')
    <!-- Modal show quick product -->
    @include('web.components.product_detail.modal_show_quick_product')
@endsection
@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="{{asset('vendors/sweetalert2/sweetalert2@11.js')}}"></script>
    <script>
        function remove_background() {
            for (let count = 1; count <= 5; count++) {
                $('#ratingProduct' + count).css('color', '#ccc')
            }
        }

        //hover chu???t ????nh gi??
        $(document).on('mouseenter', '.ratting', function (e) {
            let index = $(this).data('index')
            let product_id = $(this).data('product_id')
            remove_background()
            for (let count = 1; count <= index; count++) {
                $('#ratingProduct' + count).css('color', '#ffcc00')
            }
        });

        //nh??? chu???t kh??ng ????nh gi??
        $(document).on('mouseleave', '.ratting', function (e) {
            let index = $(this).data('index')
            var product_id = $(this).data('product_id')
            let ratting = $(this).data('ratting')
            remove_background()
            for (let count = 1; count <= ratting; count++) {
                $('#ratingProduct' + count).css('color', '#ffcc00')
            }
        });


        //click ????nh gi?? sao
        $(document).on('click', '.ratting', function (e) {
            let index = $(this).data('index')
            let product_id = $(this).data('product_id')
            let urlRatting = $(this).data('url')
            Swal.fire({
                title: "????nh gi?? " + index + " sao cho s???n ph???m n??y",
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
                        url: urlRatting,
                        data: {index: index, product_id: product_id},
                        success: function (data) {
                            if (data.code === 200) {
                                Swal.fire(
                                    '',
                                    'C???m ??n ????nh gi?? c???a b???n',
                                    'success'
                                )
                                setTimeout(function () {
                                    window.location.reload()
                                }, 500)
                            }
                        },
                        error: function () {
                            Swal.fire(
                                '',
                                'B???n ???? ????nh gi?? cho s???n ph???m n??y tr?????c ????',
                            )
                        }
                    })
                }
            })
        });


        function addToCart(e) {
            e.preventDefault();
            let urlRequest = $(this).data('url');
            let productQuantity = $('#product-quantity').val();
            Swal.fire({
                title: 'Th??m s???n ph???m v??o gi??? h??ng?',
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
                        data: {productQuantity: productQuantity},
                        success: function (data) {
                            if (data.code === 200) {
                                Swal.fire(
                                    '',
                                    'Th??m s???n ph???m v??o gi??? h??ng th??nh c??ng',
                                    'success'
                                )
                                setTimeout(function () {
                                    window.location.reload()
                                }, 500)
                            }
                        },
                        error: function () {
                            Swal.fire(
                                '',
                                'Vui l??ng ????ng nh???p',
                                'warning'
                            )
                        }
                    })
                }
            })
        }

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
            let productQuantity = $('#product_quick_quantity').val();
            Swal.fire({
                title: 'Th??m s???n ph???m v??o gi??? h??ng?',
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
                                    'Th??m s???n ph???m v??o gi??? h??ng th??nh c??ng',
                                    'success'
                                )
                                setTimeout(function () {
                                    window.location.reload()
                                }, 500)
                            }
                        },
                        error: function () {
                            Swal.fire(
                                '',
                                'Vui l??ng ????ng nh???p',
                                'warning'
                            )
                        }
                    })
                }
            })
        }

        //show form s???a comment
        function userEditComment(e) {
            e.preventDefault()
            url = $(this).data('url')
            $.ajax({
                type: 'get',
                url: url,
                success: function (response) {
                    $('#comment_content').val(response.data.content)
                    $('#comment_description').val(response.data.description)
                    $('#comment_id').val(response.data.id)
                    $('#form_edit_comment').attr('data-url', '{{route('web.update_comment')}}')
                },
                error: function () {

                },
            })
        }

        //update sau khi s???a comment
        function userUpdateComment(e) {
            e.preventDefault()
            let url = $('#form_edit_comment').attr('data-url')
            let comment_id = $('#comment_id').val()
            let descriptionComment = $('#comment_description').val()
            let contentComment = $('#comment_content').val()
            let _token = $('input[name="_token"]').val()
            $.ajax({
                type: 'post',
                url: url,
                data: {
                    comment_id: comment_id,
                    descriptionComment: descriptionComment,
                    contentComment: contentComment,
                    _token: _token
                },
                success: function (data) {
                    alert('S???a b??nh lu???n th??nh c??ng')
                    setTimeout(function () {
                        window.location.reload()
                    }, 500)
                },
                error: function () {

                }
            })
        }

        $(function () {
            $('.add-to-cart.addCart').on('click', addToCart)
            $('.add-to-cart').on('click', viewProduct)
            $('.add-to-cart.buyQuick').on('click', addQuickCart)
            $('.user_edit_comment').on('click', userEditComment)
            $('.update_comment').on('click', userUpdateComment)
        })
    </script>


    <!--click show  c??i ???nh ph??? -->
    <script>

        function showProductImage(imageId) {
            let image = $('.anh_phu_' + imageId).attr('src');
            $('#anh_chinh').attr('src', image);
        }

        <!--hover chu???t show ???nh ph???-->
        $(document).on('mouseenter', '.show-anh-phu', function () {
            let images = $(this).attr('src');
            $('#anh_chinh').attr('src', images);
        })

        <!--zoom anh-->
        $(document).on('click', '#zoom_image', function () {
            $('#anh_chinh').css('background-color', 'red');
        })
    </script>
    <div id="fb-root"></div>
    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v15.0"
            nonce="U9BNvAP4"></script>
    <div id="fb-root"></div>
    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v15.0"
            nonce="6Zkb9GRq"></script>
@endsection
