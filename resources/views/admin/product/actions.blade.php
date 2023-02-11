<a class="btn btn-success" href="{{route('admin.product.edit',$row->id)}}">Edit</a>
<a onclick="return confirm('Bạn có chắc chắn muốn xóa')" class="btn btn-danger" href="{{route('admin.product.delete',$row->id)}}">Delete</a>

{{--<a class="btn btn-danger" href="#" data-id="{{$row->id}}" data-toggle="modal" data-target="#delete_confirm"> <i class="glyph-icon tooltip-button icon-trash" title="{{__('Delete')}}"></i></a>--}}

