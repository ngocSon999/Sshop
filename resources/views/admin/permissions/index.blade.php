@extends('admin.layouts.master')
@section('title')
    <title>Trang permission</title>
@endsection
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        @include('admin.layouts.partials.contentHeader',['name'=>'Permission', 'key'=>'List'])



        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <a href="{{route('admin.permission.create')}}" class="btn btn-primary float-right m-2">Thêm</a>
                    </div>
                    <div class="col-12">

                        @if(session('tb'))
                            <div class="alert alert-success">{{session('tb')}}</div>
                        @endif
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Tên menu</th>
                                <th scope="col">Action</th>
                            </tr>
                            </thead>
                            <tbody>
{{--                            @foreach($menus as $menu)--}}
{{--                                <tr>--}}
{{--                                    <th scope="row">{{$menu->id}}</th>--}}
{{--                                    <td>{{$menu->name}}</td>--}}
{{--                                    <td>--}}
{{--                                        <a class="btn btn-default" href="{{route('admin.menu.edit',$menu->id)}}">Edit</a>--}}
{{--                                        <a onclick="return confirm('Bạn có chắc chắn muốn xóa')" class="btn btn-danger" href="{{route('admin.menu.delete',$menu->id)}}">Delete</a>--}}
{{--                                    </td>--}}
{{--                                </tr>--}}
{{--                            @endforeach--}}
                            </tbody>
                        </table>
                    </div>
                    <div class="col-12 d-flex justify-content-end">
{{--                        <div>{{ $menus->links() }}</div>--}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

