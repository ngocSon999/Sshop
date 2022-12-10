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
                            <input id="product_quick_quantity" value="1" type="number">
                            <a style="margin-top: 8px" href="" class=" btn btn-default add-to-cart buyQuick"
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
