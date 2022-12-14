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
                       $(self).closest('tr').html('');
                      alert('Xóa thành công')
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




