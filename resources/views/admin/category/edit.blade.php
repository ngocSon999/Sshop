@extends('admin.layouts.master')
@section('title')
    <title>Sửa danh mục sản phẩm</title>
@endsection
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        @include('admin.layouts.partials.contentHeader',['name'=>'Category', 'key'=>'Edit'])


        <!-- Main content -->
        <div class="container">
            <div class="row">
                <div class="col-6">
                    <div>
                        @if(session('tb'))
                            <div class="alert alert-primary">{{session('tb')}}</div>
                        @endif
                        <form action="{{route('admin.category.update', ['id'=>$category->id])}}" method="POST">

                            <div class="form-group">
                                <label for="">Tên danh mục</label>
                                <input type="text" name="name" class="form-control" placeholder="Nhập tên danh mục" value="{{old('name') ?? $category->name}}">
                                @error('name')
                                <span style="color: red">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="">Chọn danh mục cha</label>
                                <select name="parent_id" id="" class="form-control">
                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                    {!! $htmlOption !!}
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Add</button>
                            @csrf
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


