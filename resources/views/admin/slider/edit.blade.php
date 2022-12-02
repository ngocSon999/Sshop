@extends('admin.layouts.master')
@section('title')
    <title>Sửa slider</title>
@endsection
@section('style')

@endsection
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        @include('admin.layouts.partials.contentHeader',['name'=>'Slider', 'key'=>'Edit'])


        <!-- Main content -->
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-6">
                    <div>
                        <form action="{{route('admin.slider.update', ['id' => $slider->id])}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="">Tên Slider</label>
                                <input type="text" name="name" class="form-control" placeholder="Nhập tên slider" value="{{old('name') ?? $slider->name}}">
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
                            <div class="row">
                                <div class="col-6">
                                    <img src="{{$slider->image_path}}"
                                         width="200px"
                                         height="200px"
                                         alt="">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="">Nội dung mô tả</label>
                                <textarea name="description" id="ckeditorSlider"  class="form-control " rows="2">{{old('description') ?? $slider->description}}</textarea>
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
    <script>
        CKEDITOR.replace( 'ckeditorSlider' );
    </script>


@endsection
