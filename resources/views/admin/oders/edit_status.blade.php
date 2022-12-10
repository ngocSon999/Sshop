@extends('admin.layouts.master')
@section('title')
    <title>Trang cập nhât trạng thái đơn hàng</title>
@endsection

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        @include('admin.layouts.partials.contentHeader',['name'=>'Edit_Status', 'key'=>''])



        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
              <div class="row">
                  <form class="col-6" action="{{route('admin.update_oder_detail',['id'=>$oderDetail->id])}}" method="POST">
                      @csrf
                     <div class="form-group">
                         <label for="">Nhập trạng thái đơn hàng</label>
                         <input name="status" class="form-control" type="text" value="{{old('status') ?? $oderDetail->status}}">
                     </div>
                      <button class="btn btn-success">Cập nhật</button>
                  </form>
              </div>

            </div>
        </div>
    </div>
@endsection


@section('js')

@endsection
