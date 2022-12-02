@extends('admin.layouts.master')
@section('title')
    <title>Roles</title>
@endsection
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        @include('admin.layouts.partials.contentHeader',['name'=>'Role', 'key'=>'List'])



        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <a href="{{route('admin.roles.create')}}" class="btn btn-primary float-right m-2">Thêm</a>
                    </div>
                    <div class="col-12">

                        @if(session('tb'))
                            <div class="alert alert-success">{{session('tb')}}</div>
                        @endif
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Tên vai trò</th>
                                <th scope="col">Mô tả vai trò</th>
                                <th scope="col">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($roles as $item)
                                <tr>
                                    <th scope="row">{{$item->id}}</th>
                                    <th>{{$item->name}}</th>
                                    <th>{{$item->display_name}}</th>
                                    <td>
                                        <a class="btn btn-default" href="{{route('admin.roles.edit',$item->id)}}">Edit</a>
                                        <a class="btn btn-danger action_delete" href=""
                                           data-url="{{route('admin.roles.delete',$item->id)}}">Delete</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="col-12 d-flex justify-content-end">
                        <div>{{ $roles->links() }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src="{{asset('vendors/sweetalert2/sweetalert2@11.js')}}"></script>
    <script src="{{asset('admins/main.js')}}"></script>
@endsection
