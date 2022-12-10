<div class="modal fade" id="viewEditComment" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="exampleModalLabel">Chỉnh sửa bình luận</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="form_edit_comment" action="" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="">Tiêu đề</label>
                        <input maxlength="150" required class="form-control" name="" id="comment_description" >
                    </div>
                    <div class="form-group">
                        <label for="">Nội dung</label>
                        <textarea maxlength="255" required class="form-control" name="" id="comment_content"  rows="5"></textarea>
                    </div>
                    <input id="comment_id" value="" type="hidden">
                </form>
                <button type="submit" class="btn btn-success btn-sm pull-right update_comment">
                    Gửi
                </button>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
