@extends('admin.layouts.master')
@section('title')
    <title>Trang Comment</title>
@endsection

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        @include('admin.layouts.partials.contentHeader',['name'=>'Comment', 'key'=>'List'])

        <div id="notify_comment"></div>

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">

                        @if(session('tb'))
                            <div class="alert alert-success">{{session('tb')}}</div>
                        @endif
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">Trạng thái</th>
                                <th scope="col">Người bình luận</th>
                                <th scope="col">Ngày gửi</th>
                                <th scope="col">Tiêu đề</th>
                                <th scope="col">Nội dung bình luận</th>
                                <th scope="col">Tên Sản phẩm</th>
                                <th scope="col">Thao tác</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(!empty($comments))
                                @foreach($comments as $comment)
                                        <tr>
                                            @if($comment->comment_status == 1)
                                                <td><input type="button" value="Duyệt"
                                                           class="btn btn-success btn-xs comment_add " href=""
                                                           data-url="{{route('web.comment.add_comment')}}"
                                                           data-comment_status="0"
                                                           data-id_comment="{{$comment->id}}">
                                                </td>
                                            @else
                                                <td><input type="button" value="Bỏ duyệt"
                                                           class="btn btn-danger btn-xs comment_add " href=""
                                                           data-url="{{route('web.comment.add_comment')}}"
                                                           data-comment_status="1"
                                                           data-id_comment="{{$comment->id}}">
                                                </td>
                                            @endif
                                            <th scope="row">{{$comment->users->name}}</th>
                                            <th scope="row">{{$comment->created_at}}</th>
                                            <th scope="row">{{$comment->description}}</th>
                                            <td scope="row">{{$comment->content}}

                                                <ul>
                                                    @foreach($comment->parentComment as $key=>$parentcomment)
                                                        <li>Trả lời {{$key+1}}: {{$parentcomment->content}}</li>
                                                    @endforeach
                                                </ul>
                                                @if($comment->comment_status == 0)
                                                    <br>
                                                    <textarea class="form-control reply_comment_{{$comment->id}}" name="" id=""  rows="2"></textarea>
                                                    <br>
                                                    <button class="btn btn-default btn-xs btn-reply-comment"
                                                            data-url-reply="{{route('web.reply_comment')}}"
                                                            data-product_id="{{$comment->product->id}}"
                                                            data-comment_id="{{$comment->id}}">Trả lời bình luận</button>
                                                @else
                                                @endif

                                            </td>
                                            <td>
                                                <img src="{{$comment->product->feature_image_path}}"
                                                     width="50px"
                                                     height="50px"
                                                     alt="">
                                                {{$comment->product->name}}
                                            </td>

                                            <td>
                                                <a class="btn btn-danger btn-xs action_delete" href="">Delete</a>
                                            </td>
                                        </tr>
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                    </div>
                    <div class="col-12 d-flex justify-content-end">
                        <div>{{ $comments->links() }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection


@section('js')
    <script src="{{asset('vendors/sweetalert2/sweetalert2@11.js')}}"></script>
    <script src="{{asset('admins/main.js')}}"></script>
    <script>
        function addComment() {
            let idComment = $(this).data('id_comment')
            let urlAddComment = $(this).data('url')
            let status_comment = $(this).data('comment_status')
            $.ajax({
                type: 'get',
                url: urlAddComment,
                dataType: 'json',
                data: {idComment: idComment,status_comment:status_comment},
                success: function (data) {
                    if(data.status === 0){
                        setTimeout(function (){
                            window.location.reload()
                        },1000)
                        $('#notify_comment').html('<p class="alert alert-success">Duyệt thành công</p>')
                    }else{
                        setTimeout(function (){
                            window.location.reload()
                        },1000)
                        $('#notify_comment').html('<p class="alert alert-success">Bỏ duyệt thành công</p>')
                    }
                },

                error: function () {

                }
            })
        }


        function replyComment(){
            let comment_id = $(this).data('comment_id')
            let comments = $('.reply_comment_'+comment_id).val();
            let urlRepComment = $(this).data('url-reply')
            let product_id = $(this).data('product_id')
            $.ajax({
                type: 'get',
                url: urlRepComment,
                dataType: 'json',
                data: {comments: comments,comment_id:comment_id,product_id:product_id},
                success: function (data) {
                    if(data.code === 200){
                        let comments = $('.reply_comment_'+comment_id).val('');
                        setTimeout(function (){
                            window.location.reload()
                        },1000)
                        $('#notify_comment').html('<p class="alert alert-success">Trả lời bình luận thành công</p>')
                    }
                },

                error: function () {

                }
            })
        }
        $(function () {
            $('.comment_add').on('click', addComment)
            $('.btn-reply-comment').on('click', replyComment)
        })
    </script>
@endsection
