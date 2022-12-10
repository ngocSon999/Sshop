@extends('admin.layouts.master')
@section('title')
    <title>Trang Oder</title>
@endsection

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        @include('admin.layouts.partials.contentHeader',['name'=>'Oder', 'key'=>'List'])



        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">

                        @if(session('tb'))
                            <div class="alert alert-success">{{session('tb')}}</div>
                        @endif
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Tên người đặt</th>
                                <th scope="col">Địa chỉ</th>
                                <th scope="col">Tổng giá tiền</th>
                                <th scope="col">Tình trạng</th>
                                <th scope="col">Hển thị</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($oderList as $oder)
                                <tr>
                                    <th scope="row">{{$oder->id}}</th>
                                    <th scope="row">{{$oder->name}}</th>
                                    <th scope="row">{{$oder->address}}</th>
                                    <th scope="row">{{number_format($oder->total_money)}}</th>
                                    <th scope="row">{{$oder->status}}</th>

                                    <td>
                                        <a class="btn btn-success btn-sm" href="{{route('admin.oder_detail',['id'=>$oder->id])}}">chi tiết</a>
                                        <a class="btn btn-danger btn-sm action_delete"  href="">Delete</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="col-12 d-flex justify-content-end">
                        <div>{{ $oderList->links() }}</div>
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
