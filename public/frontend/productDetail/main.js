function remove_background() {
    for (let count = 1; count <= 5; count++) {
        $('#ratingProduct' + count).css('color', '#ccc')
    }
}

//hover chuột đánh giá
$(document).on('mouseenter', '.ratting', function (e) {
    let index = $(this).data('index')
    let product_id = $(this).data('product_id')
    remove_background()
    for (let count = 1; count <= index; count++) {
        $('#ratingProduct' + count).css('color', '#ffcc00')
    }
});

//nhả chuột không đánh giá
$(document).on('mouseleave', '.ratting', function (e) {
    let index = $(this).data('index')
    let product_id = $(this).data('product_id')
    let ratting = $(this).data('ratting')
    remove_background()
    for (let count = 1; count <= ratting; count++) {
        $('#ratingProduct' + count).css('color', '#ffcc00')
    }
});


//click đánh giá sao
$(document).on('click', '.ratting', function (e) {
    let index = $(this).data('index')
    let product_id = $(this).data('product_id')
    let urlRatting = $(this).data('url')
    Swal.fire({
        title: "Đánh giá " + index + " sao cho sản phẩm này",
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
                dataType: 'json',
                data: {index: index, product_id: product_id},
                success: function (data) {
                    if (data.code === 200) {
                        Swal.fire(
                            '',
                            'Cảm ơn đánh giá của bạn',
                            'success'
                        )
                    }
                },
                error: function () {
                    Swal.fire(
                        '',
                        'Bạn đã đánh giá cho sản phẩm này trước đó',
                    )
                }
            })
        }
    })
    // $.ajax({
    //     type: 'get',
    //     url: urlRatting,
    //     dataType: 'json',
    //     data:{index:index,product_id:product_id},
    //     success: function (data){
    //         if(data.code === 200){
    //             alert('Bạn đã đánh giá ' + index + ' trên 5')
    //         }
    //     },
    //     error: function (){
    //             alert('Bạn đã đánh giá san pham nay roi nha ' )
    //     },
    //
    // })
});


function addToCart(e) {
    e.preventDefault();
    let urlRequest = $(this).data('url');
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
                data: {productQuantity: productQuantity},
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

function userEditComment(e){
    e.preventDefault()
    alert('hello')
}

$(function () {
    $('.add-to-cart.addCart').on('click', addToCart)
    $('.add-to-cart').on('click', viewProduct)
    $('.add-to-cart.buyQuick').on('click', addQuickCart)
    $('.user_edit_comment').on('click', userEditComment)
})
