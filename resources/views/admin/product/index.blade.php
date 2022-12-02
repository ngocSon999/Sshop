@extends('admin.layouts.master')
@section('title')
    <title>Trang sản phẩm</title>
@endsection

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        @include('admin.layouts.partials.contentHeader',['name'=>'Product', 'key'=>'List'])



        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <a href="{{route('admin.product.create')}}" class="btn btn-primary float-right m-2">Thêm</a>
                    </div>
                    <div class="col-12">

                        @if(session('tb'))
                            <div class="alert alert-success">{{session('tb')}}</div>
                        @endif
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Tên sản phẩm</th>
                                <th scope="col">Giá</th>
                                <th scope="col">Hình ảnh</th>
                                <th scope="col">Danh mục</th>
                                <th scope="col">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($productList as $product)

                                <tr>
                                    <th scope="row">{{$product->id}}</th>
                                    <th scope="row">{{$product->name}}</th>
                                    <th scope="row">{{number_format($product->price)}}</th>
                                    <th scope="row"><img src="{{$product->feature_image_path}}"
                                                         width="150px"
                                                         height="150px"
                                                         alt=""
                                                    >
                                    </th>
                                    <th scope="row">{{optional($product->category)->name}}</th>
                                    <td>
                                        <a class="btn btn-default" href="{{route('admin.product.edit',$product->id)}}">Edit</a>
                                        <a class="btn btn-danger action_delete"  href=""
                                           data-url="{{route('admin.product.delete',$product->id)}}">Delete</a>
{{--                                        <a onclick="return confirm('Bạn có chắc chắn muốn xóa')" class="btn btn-danger" href="{{route('admin.product.delete',$product->id)}}">Delete</a>--}}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="col-12 d-flex justify-content-end">
                        <div>{{ $productList->links() }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('js')
    <script src="{{asset('vendors/sweetalert2/sweetalert2@11.js')}}"></script>
    <script src="{{asset('admins/main.js')}}"></script>
    <script>

    </script>
@endsection
