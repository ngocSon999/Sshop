@extends('admin.layouts.master')
@section('title')
    <title>Trang Contact</title>
@endsection

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        @include('admin.layouts.partials.contentHeader',['name'=>'Contact', 'key'=>'List'])

        <div id="notify_comment"></div>

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div id="thongbao"></div>
                <div class="row">
                    <div class="col-12">

                        @if(session('tb'))
                            <div class="alert alert-success">{{session('tb')}}</div>
                        @endif
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Người gửi</th>
                                <th scope="col">Email</th>
                                <th scope="col">Số điện thoại</th>
                                <th scope="col">Ngày gửi</th>
                                <th scope="col">Tiêu đề</th>
                                <th scope="col">Nội dung</th>
                                <th scope="col">Thao tác</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($contacts as $key=>$contact)
                                <tr>
                                    <th scope="row">{{$contact->id}}</th>
                                    <th scope="row">{{$contact->contact_name}}</th>
                                    <th scope="row">{{$contact->contact_email}}</th>
                                    <th scope="row">{{$contact->contact_phone}}</th>
                                    <th scope="row">{{$contact->created_at}}</th>
                                    <th scope="row">{{$contact->contact_subject}}</th>
                                    <th scope="row">{{$contact->contact_content}}</th>
                                    <td>
                                        <button onclick="return confirm('Bạn muốn xóa nội dung này?')" type="button" data-url="{{route('admin.contact.delete_contact')}}"
                                                data-contact_id="{{$contact->id}}"
                                                class="btn btn-success btn-xs delete_contact">Xóa</button>
                                        @csrf
                                        <button type="button" class="btn btn-success btn-xs">Trả lời</button>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="col-12 d-flex justify-content-end">
                        <div>{{ $contacts->links() }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{asset('vendors/sweetalert2/sweetalert2@11.js')}}"></script>
    <script>

        function deleteContact(){
            let url = $(this).data('url');
            let contact_id = $(this).data('contact_id')
            let _token=$('input[name="_token"]').val()
            $.ajax({
                type: 'delete',
                url:url,
                data:{contact_id:contact_id,_token:_token},
                success: function (response){
                    $('#thongbao').html('<p  class="alert alert-success">Xóa thành công</p>')
                    setTimeout(function (){
                        window.location.reload()
                    },500)
                },
                error: function (){

                },

            })
        }


        $(function () {
            $('.delete_contact').on('click', deleteContact)
        })
    </script>
@endsection
