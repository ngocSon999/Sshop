@extends('admin.layouts.master')
@section('title')
    <title>Sửa Role</title>
@endsection
@section('style')

@endsection
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        @include('admin.layouts.partials.contentHeader',['name'=>'Role', 'key'=>'edit'])


        <!-- Main content -->
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <form action="{{route('admin.roles.update',['id'=>$role->id])}}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="">Tên Role</label>
                            <input type="text" name="name" class="form-control" placeholder="Nhập tên role" value="{{old('name') ?? $role->name}}">
                            @error('name')
                            <span style="color:red">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Tên vai trò</label>
                            <textarea class="form-control" name="display_name"  cols="30" rows="3">{{old('display_name') ?? $role->display_name}}</textarea>
                            @error('display_name')
                            <span style="color:red">{{$message}}</span>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="row">
                                <label for="">
                                    <input type="checkbox" class="check_all">
                                    Check_all
                                </label>
                            </div>
                            @foreach($permissionsParent as $permissionParentItem)
                                <div class="card  mb-3 col-12 ml-2">

                                    <div class="card-header bg-blue">
                                        <label for="">
                                            <input type="checkbox" class="checkbox_wrapper">
                                        </label>
                                        Module {{$permissionParentItem->name}}
                                    </div>

                                    <div class="row">

                                        @foreach($permissionParentItem->rolesChildrent as $permissionChildrentItem)
                                            <div class="card-body text-primary col-3">
                                                <h4 class="card-title">
                                                    <label>
                                                        <input name="permission_id[]" type="checkbox" value="{{$permissionChildrentItem->id}}"
                                                               class="checkbox_childrent"
                                                        {{$permissionsChecked->contains('id',$permissionChildrentItem->id)? 'checked' : ''}}
                                                        >
                                                    </label>
                                                    {{$permissionChildrentItem->display_name}}
                                                </h4>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <button type="submit" class="btn btn-primary">Add</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $('.checkbox_wrapper').on('click', function (){
            $(this).parents('.card').find('.checkbox_childrent').prop('checked',$(this).prop('checked'))
        })
        $('.check_all').on('click', function (){
            $(this).parents().find('.checkbox_childrent').prop('checked',$(this).prop('checked'))
            $(this).parents().find('.checkbox_wrapper').prop('checked',$(this).prop('checked'))
        })
    </script>

@endsection
