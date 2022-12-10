@extends('admin.layouts.master')
@section('title')
    <title>Trang video</title>
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


                        <div id="video_load"></div>
                    </div>
                    <div class="col-12 d-flex justify-content-end">
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection


@section('js')
    <script src="{{asset('adminlte/plugins/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('vendors/sweetalert2/sweetalert2@11.js')}}"></script>
    <script src="{{asset('admins/main.js')}}"></script>
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
@endsection
