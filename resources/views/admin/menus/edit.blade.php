@extends('admin.layouts.master')
@section('title')
    <title>Sửa Tên Menu</title>
@endsection
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        @include('admin.layouts.partials.contentHeader',['name'=>'Menu', 'key'=>'Edit'])


        <!-- Main content -->
        <div class="container">
            <div class="row">
                <div class="col-6">
                    <div>
                        @if(session('tb'))
                            <div class="alert alert-primary">{{session('tb')}}</div>
                        @endif
                        <form action="{{route('admin.menu.update',['id'=>$menuEdit->id])}}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="">Tên Menus</label>
                                <input type="text" name="name" class="form-control" placeholder="Nhập tên danh mục" value="{{old('name') ?? $menuEdit->name}}">
                                @error('name')
                                <span style="color: red">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="">Chọn menus Cha</label>
                                <select name="parent_id" id="" class="form-control">
                                    <option value="{{$menuEdit->id}}">{{$menuEdit->name}}</option>
                                    {!! $htmlOption !!}
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Add</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


