@extends('admin.layouts.master')
@section('title')
    <title>Trang video</title>
@endsection
@section('style')

@endsection
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        @include('admin.layouts.partials.contentHeader',['name'=>'Video', 'key'=>'List'])

        <div id="notify_comment"></div>

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">

                        @if(session('tb'))
                            <div class="alert alert-success">{{session('tb')}}</div>
                        @endif
                            <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#modal_add_video">Thêm</button>
                        <div id="message_tb"></div>
                        <div id="video_load"></div>
                    </div>
                    <div class="col-12 d-flex justify-content-end">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal add video -->
    <div class="modal fade" id="modal_add_video">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Thêm video</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="hide" id="message_add_video"></div>
                    <form action="">
                        <div class="form-group">
                            <label for="">Tên video</label>
                            <input class="form-control" type="text" id="video_name">
                        </div>
                        <div class="form-group">
                            <label for="">Link video</label>
                            <input class="form-control" type="text" id="video_link">
                        </div>
                        <div class="form-group">
                            <label for="">Tiêu đề</label>
                            <input class="form-control" type="text" id="video_title">
                        </div>
                        <div class="form-group">
                            <label for="">Mô tả</label>
                            <input class="form-control" type="text" id="video_description">
                        </div>

                        <button type="button" data-url="{{route('admin.video.add_video')}}" class="btn btn-success btn-sm btn-add-video">Thêm</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal edit video -->
    <div class="modal fade" id="modal_edit_video">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit video</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="hide" id="message_add_video"></div>
                    <form action="">
                        <div class="form-group">
                            <label for="">Tên video</label>
                            <input class="form-control" type="text" id="video_name">
                        </div>
                        <div class="form-group">
                            <label for="">Link video</label>
                            <input class="form-control" type="text" id="video_link">
                        </div>
                        <div class="form-group">
                            <label for="">Tiêu đề</label>
                            <input class="form-control" type="text" id="video_title">
                        </div>
                        <div class="form-group">
                            <label for="">Mô tả</label>
                            <input class="form-control" type="text" id="video_description">
                        </div>

                        <button data-url="{{route('admin.video.add_video')}}" class="btn btn-success btn-sm btn-add-video">Submit</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('js')
    <script src="{{asset('adminlte/plugins/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('vendors/sweetalert2/sweetalert2@11.js')}}"></script>
    <script src="{{asset('admins/main.js')}}"></script>
    <!--load video-->
    <script>
        function load_video() {
            $.ajax({
                url: '{{route('admin.video.select_video')}}',
                type: 'post',
                headers: {
                    'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
                },
                success: function (data) {
                    $('#video_load').html(data);
                },
                error: function () {
                }
            })
        }
        $(document).ready(function (){
            load_video()
        })
    </script>

    <!--delete video-->
    <script>
        $(document).on('click','.delete-video',function (e){
            let video_id = $(this).data('video_id');
            if(confirm('Bạn muốn xóa video này không?')){
                $.ajax({
                    url:'{{route('admin.video.delete_video')}}',
                    type:'delete',
                    headers: {
                        'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
                    },
                    data:{video_id:video_id},
                    success:function (){
                        load_video()
                    },
                    error:function (){

                    }
                })
            }

        })
    </script>
    <!--edit video-->
    <script>
       $(document).on('blur','.editVideo', function editVideo(videoid) {
           var video_type = $(this).data('video_type');

           var video_id = $(this).data('video_id');
           var video_edit = $('#'+video_type+'_'+video_id).text();
           $.ajax({
               type: 'post',
               url: '{{route('admin.video.update_video')}}',
               headers: {
                   'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
               },
               data: {video_type: video_type, video_id: video_id, video_edit: video_edit},
               success: function () {
                   $('#message_tb').html('<p class="alert alert-success">update Thành công</p>')
                   load_video()
                   setTimeout(function (){
                       $('#message_tb').html('')
                   },3000)
               },
               error: function () {

               }
           })
       })
    </script>

    <!--Thử sau-->
    <script>
           function editVideo(e){
               e.preventDefault()
            let video_id = $(this).data('video_id');
            alert(video_id);
        }
           $('.btn-edit-video').on('click',editVideo)
    </script>

    <script>
        function addVideo(event){
            event.preventDefault()
            let url=$(this).data('url');
            let video_name = $('#video_name').val()
            let video_link = $('#video_link').val();
            let video_title = $('#video_title').val()
            let video_description = $('#video_description').val()
            $.ajax({
                url:url,
                type:'post',
                headers:{
                    'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
                },
                data:{
                    video_name:video_name,
                    video_link:video_link,
                    video_title:video_title,
                    video_description:video_description,
                },
                success: function (){
                    $('#message_add_video').html('<p class="alert alert-success">Thêm video thành công</p>')
                    load_video()
                    $('#video_name').val('')
                    $('#video_link').val('')
                    $('#video_title').val('')
                    $('#video_description').val('')

                    setTimeout(function (){
                        $('#modal_add_video').modal('hide');
                    },1000)
                },
                error: function (){

                }
            })
        }
        $('.btn-add-video').on('click',addVideo)
    </script>
@endsection

