@extends('admin.layouts.master')
@section('title')
    <title>Thêm menu</title>
@endsection
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        @include('admin.layouts.partials.contentHeader',['name'=>'Menu', 'key'=>'Create'])


        <!-- Main content -->
        <div class="container">
            <div class="row">
                <div class="col-6">
                    <div>
                        <form action="{{route('admin.menu.store')}}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="">Tên menus</label>
                                <input type="text" name="name" class="form-control" placeholder="Nhập tên menu">
                                @error('name')
                                <span style="color:red">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="">Chọn menus cha</label>
                                <select name="parent_id" id="" class="form-control">
                                    <option value="0">Chọn menus cha</option>
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


