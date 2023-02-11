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
                        <table class="table" id="table_product_list">
                            <thead>
                            <tr>
                                <th scope="col">{{__('product/title.id')}}</th>
                                <th scope="col">{{__('product/title.name')}}</th>
                                <th scope="col">{{__('product/title.price')}}</th>
                                <th scope="col">{{__('product/title.feature_image_path')}}</th>
                                <th scope="col">{{__('product/title.category')}}</th>
                                <th scope="col">{{__('product/title.actions')}}</th>
                            </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
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
        $(document).ready(function (){
            $('#table_product_list').DataTable({
                processing: true,
                serverSide: true,
                aLengthMenu: [2, 25, 50],
                pageLength: 10,
                oLanguage: {
                    sLengthMenu: "{{ __('datatable/title.datatable.item_per_page') }}", // item per page text
                    sSearch: "{{ __('datatable/title.datatable.search') }}", // item per page text
                    sInfo: "{{ __('datatable/title.datatable.pagination_info') }}", // item per page text
                    oPaginate: {
                        sPrevious: "{{ __('datatable/title.datatable.pagination_previous') }}",
                        sNext: "{{ __('datatable/title.datatable.pagination_next') }}"
                    }
                },
                ajax: '{{ route('admin.product.data') }}',
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'name', name: 'name' },
                    { data: 'price', name: 'price' },
                    { data: 'feature_image_path', name: 'feature_image_path' },
                    { data: 'category_id', name: 'category_id' },
                    { data: 'actions', name: 'actions' },
                ]
            })
        })
    </script>
@endsection
