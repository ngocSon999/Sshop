@extends('admin.layouts.master')
@section('title')
    <title>Sửa User</title>
@endsection
@section('style')
    <link href="{{asset('/vendors/select2/select2.min.css')}}" rel="stylesheet" />
    <link rel="stylesheet" href="{{asset('admins/user/style.css')}}">
@endsection

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        @include('admin.layouts.partials.contentHeader',['name'=>'User', 'key'=>'Edit'])

        <!-- Main content -->
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-6">
                    <div>
                        <form action="{{route('admin.user.update',$user->id)}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="">Tên</label>
                                <input type="text" name="name" class="form-control" placeholder="Nhập tên user" value="{{old('name') ?? $user->name}}">
                                @error('name')
                                <span style="color:red">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="">email</label>
                                <input type="text" name="email" class="form-control" placeholder="Nhập email" value="{{old('email') ?? $user->email}}">
                                @error('email')
                                <span style="color:red">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="">Password</label>
                                <input type="password" name="password" class="form-control" placeholder="Nhập password" >
                                @error('password')
                                <span style="color:red">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for=""> Chọn vai trò</label>
                                <select   class="form-control select-choose" name="role_id[]" multiple="multiple" >
                                    @foreach ($roles as $role)
                                        <option value=" {{ $role->id }}"
                                                {{$roleUser->contains('id',$role->id ) ? 'selected' : ''}}
                                        >{{ $role->name }}</option><!--kiểm tra giá trị có nằm trong mảng-->
                                    @endforeach
                                </select>
                                @error('tags')
                                <span style="color:red">{{$message}}</span>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary">Add</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{asset('/vendors/select2/select2.min.js')}}"></script>
    <script src="{{asset('admins/user/main.js')}}"> </script>
@endsection
