@extends('admin.layouts.master')
@section('title')
    <title>Trang chủ</title>
@endsection
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        @include('admin.layouts.partials.contentHeader',['name'=>'Category', 'key'=>'List'])



        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <a href="{{route('admin.category.create')}}" class="btn btn-primary float-right m-2">Thêm</a>
                    </div>
                    <div class="col-12">

                        @if(session('tb'))
                            <div class="alert alert-primary">{{session('tb')}}</div>
                        @endif
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($categories as $key=>$category)
                                <tr>
                                    <th scope="row">{{$category->id}}</th>
                                    <td>{{$category->name}}</td>
                                    <td>
                                        @can('category_edit')
                                            <a class="btn btn-default"
                                               href="{{route('admin.category.edit',$category->id)}}">Edit</a>
                                        @endcan
                                        @can('category_delete')
                                            <a onclick="return confirm('Bạn có chắc chắn muốn xóa')"
                                               class="btn btn-danger"
                                               href="{{route('admin.category.delete',$category->id)}}">Delete</a>
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="col-12 d-flex justify-content-end">
                        <div>{{ $categories->links() }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

