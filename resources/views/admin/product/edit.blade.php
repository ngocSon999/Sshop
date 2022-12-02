@extends('admin.layouts.master')
@section('title')
    <title>Sửa sản phẩm</title>
@endsection
@section('style')
    <link href="{{asset('/vendors/select2/select2.min.css')}}" rel="stylesheet" />
@endsection
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        @include('admin.layouts.partials.contentHeader',['name'=>'Product', 'key'=>'Edit'])


        <!-- Main content -->
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-6">
                    <div>
                        <form action="{{route('admin.product.update',['id'=>$product->id])}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="">Tên Product</label>
                                <input type="text" name="name" class="form-control" value="{{old('name') ?? $product->name}}" placeholder="Nhập tên sản phẩm">
                                @error('name')
                                <span style="color:red">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="">Giá sản phẩm</label>
                                <input type="text" name="price" class="form-control" value="{{old('price') ?? number_format($product->price)}}" placeholder="Nhập giá sản phẩm">
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
                               <div class="row">
                                   <img src="{{$product->feature_image_path}}"
                                        width="200px"
                                        height="200px"
                                        alt="">
                               </div>
                            </div>
                            <div class="form-group">
                                <label for="">Ảnh chi tiết</label>
                                <input multiple type="file" name="image_path[]" class="form-control-file">
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    @foreach($product->images as $item)
                                        <div class="col-3">
                                            <img src="{{$item->image_path}}"
                                                 width="100px"
                                                 height="100px"
                                                 alt="">
                                        </div>
                                    @endforeach

                                </div>
                            </div>


                            <div class="form-group">
                                <label for="">Chọn danh mục</label>
                                <select name="category_id"  class="form-control select2-init">
                                    <option value="">Chọn danh mục</option>
                                    {!! $htmlOption !!}
                                </select>
                            </div>

                            <div class="form-group">
                                <label for=""> Nhập tags cho sản phẩm </label>
                                <select  class="form-control select-choose" name="tags[]" multiple="multiple">
                                    @foreach($product->tags as $tagList)
                                        <option selected value="{{$tagList->name}}">{{$tagList->name}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="">Nội dung mô tả</label>
                                <textarea name="contents" id="ckeditor1"  class="form-control " rows="2">{{$product->content}}</textarea>
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

    <script>
        CKEDITOR.replace( 'ckeditor1' );
    </script>


@endsection
