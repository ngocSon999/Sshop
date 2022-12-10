@extends('admin.layouts.master')
@section('title')
    <title>Trang danh sách nhân viên</title>
@endsection
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        @include('admin.layouts.partials.contentHeader',['name'=>'User', 'key'=>'List'])



        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <a href="{{route('admin.user.create')}}" class="btn btn-primary float-right m-2">Thêm</a>
                    </div>
                    <div class="col-12">

                        @if(session('tb'))
                            <div class="alert alert-success">{{session('tb')}}</div>
                        @endif
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Tên</th>
                                <th scope="col">Hình ảnh</th>
                                <th scope="col">Email</th>
                                <th scope="col">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($userList as $user)
                                <tr id="user{{$user->id}}">
                                    <th scope="row">{{$user->id}}</th>
                                    <td>{{$user->name}}</td>
                                    <td><img src="{{$user->user_image_path}}" width="100px" height="100px" alt=""></td>
                                    <td>{{$user->email}}</td>
                                    <td>
                                        <a class="btn btn-default" href="{{route('admin.user.edit',$user->id)}}">Edit</a>
                                        <a class="btn btn-danger action_delete" href=""
                                           data-url="{{route('admin.user.delete')}}"
                                            data-user_id="{{$user->id}}"
                                        >Delete</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="col-12 d-flex justify-content-end">
                        <div>{{ $userList->links() }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src="{{asset('vendors/sweetalert2/sweetalert2@11.js')}}"></script>
{{--    <script src="{{asset('admins/main.js')}}"></script>--}}
    <script>
        function actionDelete(e){
            e.preventDefault();
            let urlRequest = $(this).data('url');
            let user_id = $(this).data('user_id');
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
                        data:{user_id:user_id},
                        success: function (data){
                            if (data.code === 200){
                               var abx = $('#user' + user_id).remove();
                                Swal.fire(
                                    'Xong',
                                    'Sản phẩm đã xóa khỏi hệ thống',
                                    'success'
                                )
                                window.location.reload()
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

    </script>
@endsection

