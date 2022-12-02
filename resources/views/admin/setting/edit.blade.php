@extends('admin.layouts.master')
@section('title')
    <title>Editb Setting</title>
@endsection
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        @include('admin.layouts.partials.contentHeader',['name'=>'Setting', 'key'=>'Edit'])


        <!-- Main content -->
        <div class="container">
            <div class="row">
                <div class="col-6">
                    <div>
                        <form action="{{route('admin.setting.update',['id'=>$setting->id])}}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="">Config key</label>
                                <input type="text" name="config_key" class="form-control" placeholder="Nhập config_key"
                                value="{{old('config_key') ?? $setting->config_key}}">
                                @error('config_key')
                                <span style="color:red">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                @if($setting->type === 'text')
                                    <label for="">Config value</label>
                                    <input type="text" name="config_value" class="form-control" placeholder="Nhập config_value"
                                    value="{{old('config_value') ?? $setting->config_value}}">
                                    @error('config_value')
                                    <span style="color:red">{{$message}}</span>
                                    @enderror
                                @elseif($setting->type === 'textarea')
                                    <label for="">Config value</label>
                                    <textarea name="config_value" id="ckeditorSetting"  rows="5">{{old('config_value') ?? $setting->config_value}}</textarea>
                                    @error('config_value')
                                    <span style="color:red">{{$message}}</span>
                                    @enderror
                                @endif

                            </div>
                            <button class="btn btn-primary">Add</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        CKEDITOR.replace('ckeditorSetting')
    </script>
@endsection
