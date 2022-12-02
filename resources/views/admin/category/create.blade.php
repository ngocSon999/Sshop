@extends('admin.layouts.master')
@section('title')
    <title>Thêm danh mục sản phẩm</title>
@endsection
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        @include('admin.layouts.partials.contentHeader',['name'=>'Category', 'key'=>'Create'])


        <!-- Main content -->
        <div class="container">
            <div class="row">
                <div class="col-6">
                    <div>
                        <form action="{{route('admin.category.store')}}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="">Tên danh mục</label>
                                <input type="text" name="name" class="form-control" placeholder="Nhập tên danh mục">
                                @error('name')
                                <span style="color:red">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="">Chọn danh mục cha</label>
                                <select name="parent_id" id="" class="form-control">
                                    <option value="0">Chọn danh mục cha</option>
                                    {!! $htmlOption !!}
                                </select>
                            </div>
                            <button class="btn btn-primary">Add</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


