@extends('admin.layouts.master')
@section('title')
    <title>Trang Setting</title>
@endsection
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        @include('admin.layouts.partials.contentHeader',['name'=>'Setting', 'key'=>'List'])



        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="dropdown float-right pr-5">
                            <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton1"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                Add Setting
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                <li><a class="dropdown-item"
                                       href="{{route('admin.setting.create').'?type=text'}}">Text</a></li>
                                <li><a class="dropdown-item" href="{{route('admin.setting.create').'?type=textarea'}}">Textarea</a>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="col-12">

                        @if(session('tb'))
                            <div class="alert alert-success">{{session('tb')}}</div>
                        @endif
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Config key</th>
                                <th scope="col">Config value</th>
                                <th scope="col">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($settings as $item)
                                <tr>
                                    <th scope="row">{{$item->id}}</th>
                                    <td>{{$item->config_key}}</td>
                                    <td>{!! $item->config_value !!}</td>
                                    <td>
                                        <a class="btn btn-default"
                                           href="{{route('admin.setting.edit',$item->id)}}">Edit</a>
                                        <a class="btn btn-danger action_delete" href=""
                                           data-url="{{route('admin.setting.delete',$item->id)}}">Delete</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="col-12 d-flex justify-content-end">
                        <div>{{ $settings->links() }}</div>
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
