@extends('admin.layouts.master')
@section('title')
    <title>Trang Oder_detail</title>
@endsection

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        @include('admin.layouts.partials.contentHeader',['name'=>'Oder_detail', 'key'=>'List'])



        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    @if(session('tb'))
                        <div class="alert alert-success">{{session('tb')}}</div>
                    @endif
                </div>
                <div class="row">
                    <h3>Thông tin người mua</h3>
                    <div class="col-12">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">Tên người đặt</th>
                                <th scope="col">email</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(Auth::user()->id == $oder->user_id)
                            <tr>
                                <th scope="row">{{$user->name}}</th>
                                <th scope="row">{{$user->email}}</th>
                            </tr>
                            @endif
                            </tbody>
                        </table>
                    </div>
                    <div class="col-12 d-flex justify-content-end">
                    </div>
                </div>
                <div class="row mt-4">
                    <h3>Thông tin giao hàng</h3>
                    <div class="col-12">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">Mã đơn hàng</th>
                                <th scope="col">Tên người nhận</th>
                                <th scope="col">email</th>
                                <th scope="col">Địa chỉ</th>
                                <th scope="col">Số điện thoại</th>
                                <th scope="col">Ghi chú</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <th scope="row">{{$oder->id}}</th>
                                <th scope="row">{{$oder->name}}</th>
                                <th scope="row">{{$oder->email}}</th>
                                <th scope="row">{{$oder->address}}</th>
                                <th scope="row">{{$oder->phone}}</th>
                                <th scope="row">{{$oder->note}}</th>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-12 d-flex justify-content-end">
                    </div>
                </div>
                <div class="row mt-4">
                    <h3>Chi tiết đơn hàng</h3>
                    <div class="col-12">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Tên sản phẩm</th>
                                <th scope="col">Hình ảnh</th>
                                <th scope="col">Đơn giá</th>
                                <th scope="col">Số lượng</th>
                                <th scope="col">Tổng tiền đã tính thuế</th>
                                <th scope="col">Trạng thái</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(!empty($oderDetails))
                                @foreach($oderDetails as $key=>$oderDetail)
                                    <tr>
                                        <th scope="row">{{$key+1}}</th>
                                        <th scope="row">{{$oderDetail->name}}</th>
                                        <th scope="row"><img src="{{$oderDetail->image_path}}" width="50px"
                                                             height="50px" alt=""></th>
                                        <th scope="row">{{number_format($oderDetail->price)}}</th>
                                        <th scope="row">{{$oderDetail->quantity}}</th>
                                        <th scope="row">{{number_format($oderDetail->total_money)}}</th>
                                        <td scope="row">
                                            <a>{{$oderDetail->status}}</a>
                                            <a class="btn btn-success btn-sm" href="{{route('admin.edit_oder_detail',['id'=>$oderDetail->id])}}">Cập nhật</a>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                        @php
                            if(!empty($oderDetails)){
                                 $totalPrice=0;
                                foreach($oderDetails as $key=>$oderDetail){
                                    $totalPrice += $oderDetail->total_money;
                                }
                            }

                        @endphp
                        <div style="color: red" class="mt-4">Tổng tiền đơn hàng: {{number_format($totalPrice)}} đ</div>
                    </div>
                    <div class="col-12 d-flex justify-content-end">
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
