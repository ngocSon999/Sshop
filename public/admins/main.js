function actionDelete(e){
    e.preventDefault();
    let urlRequest = $(this).data('url');
    Swal.fire({
        title: 'Bạn có muốn xóa sản phẩm này?',
        text: "Chọn OK để xóa, Cancel để quay lại",
        icon: 'warning',
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
                success: function (data){
                   if (data.code === 200){
                       $(self).closest('tr').remove();
                       Swal.fire(
                           'Xong',
                           'Sản phẩm đã xóa hỏi hệ thống',
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

$(function (){
    $(document).on('click','.action_delete', actionDelete)
})




