@extends('admin.layouts.master')
@section('title')
    <title>Thêm sản phẩm</title>
@endsection
@section('style')
    <link href="{{asset('/vendors/select2/select2.min.css')}}" rel="stylesheet" />
    <style></style>
@endsection
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        @include('admin.layouts.partials.contentHeader',['name'=>'Product', 'key'=>'Create'])

        <!-- Main content -->
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-6">
                    <div>
                        <form action="{{route('admin.product.store')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="">Tên Product</label>
                                <input type="text" name="name" class="form-control" placeholder="Nhập tên sản phẩm" value="{{old('name')}}">
                                @error('name')
                                <span style="color:red">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="">Giá sản phẩm</label>
                                <input type="text" name="price" class="form-control money-format" placeholder="Nhập giá sản phẩm" value="{{old('price')}}">
                                @error('price')
                                <span style="color:red">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="">Ảnh đại diện</label>
                                <input type="file" name="feature_image_path" class="form-control-file">
                                @error('feature_image_path')
                                <span style="color:red">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="">Ảnh chi tiết</label>
                                <input multiple type="file" name="image_path[]" class="form-control-file" >
                                @error('image_path')
                                <span style="color:red">{{$message}}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="">Chọn danh mục</label>
                                <select name="category_id"  class="form-control select2-init" >
                                    <option value="">Chọn danh mục</option>
                                    {!! $htmlOption !!}
                                </select>
                                @error('category_id')
                                <span style="color:red">{{$message}}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for=""> Nhập tags cho sản phẩm </label>
                                <select class="form-control select-choose" name="tags[]" multiple="multiple" >

                                </select>
                                @error('tags')
                                <span style="color:red">{{$message}}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="">Nội dung mô tả</label>
                                <textarea name="contents" id="ckeditor1"  class="form-control " rows="2">{{old('contents')}}</textarea>
                                @error('contents')
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
    <script src="{{asset('admins/products/create/create.js')}}"></script>
    <script src="{{asset('admins/simple.money.format.js')}}"></script>
    <script type="text/javascript">
        CKEDITOR.replace('ckeditor1');
        $('.money-format').simpleMoneyFormat();
    </script>


@endsection
