@extends('admin.layouts.master')
@section('title')
    <title>Thêm slider</title>
@endsection
@section('style')
    <link href="{{asset('/vendors/select2/select2.min.css')}}" rel="stylesheet" />
@endsection
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        @include('admin.layouts.partials.contentHeader',['name'=>'Slider', 'key'=>'Create'])


        <!-- Main content -->
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-6">
                    <div>
                        <form action="{{route('admin.slider.store')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="">Tên Slider</label>
                                <input type="text" name="name" class="form-control" placeholder="Nhập tên slider" value="{{old('name')}}">
                                @error('name')
                                <span style="color:red">{{$message}}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="">Ảnh đại diện</label>
                                <input type="file" name="image_path" class="form-control-file" >
                                @error('image_path')
                                <span style="color:red">{{$message}}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="">Nội dung mô tả</label>
                                <textarea name="description" id="ckeditorSlider"  class="form-control " rows="2">{{old('description')}}</textarea>
                                @error('description')
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
    <script src="{{asset('admins/sliders/create/create.js')}}"></script>

    <script>
        CKEDITOR.replace( 'ckeditorSlider' );
    </script>


@endsection
