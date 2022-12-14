@extends('admin.layouts.master')
@section('title')
    <title>Thêm permission</title>
@endsection
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        @include('admin.layouts.partials.contentHeader',['name'=>'Permission', 'key'=>'Create'])


        <!-- Main content -->
        <div class="container">
            <div class="row">
                <div class="col-12">

                        <form action="{{route('admin.permission.store')}}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="">Chọn tên module</label>
                                <select name="module_parent" id="" class="form-control">
                                    <option value="">Chọn tên module</option>
                                    @foreach(config('permissions.tableModule') as $moduleItem)
                                        <option value="{{$moduleItem}}">{{$moduleItem}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="row">
                                        <label for="">
                                            <input type="checkbox" class="check_all">
                                            Check_all
                                        </label>
                                    </div>
                                    @foreach(config('permissions.moduleChildrent') as $moduleChildrentItem)
                                    <div class="col-3">
                                        <label for="">
                                            <input name="module_child[]" type="checkbox" value="{{$moduleChildrentItem}}"
                                                   class="checkbox_wrapper">
                                            {{$moduleChildrentItem}}
                                        </label>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            <button class="btn btn-primary">Add</button>
                        </form>

                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $('.check_all').on('click', function (){
            $(this).parents().find('.checkbox_wrapper').prop('checked',$(this).prop('checked'))
        })
    </script>

@endsection


