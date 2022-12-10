<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Service\admins\OderService;
use App\Models\Oder;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\OderDetail;

class OdersController extends Controller
{
    private $oderService;
    public function __construct(OderService $oderService){
        $this->oderService=$oderService;
    }
    public function index(){
        $oderList = $this->oderService->getList();
        return view('admin.oders.index',compact('oderList'));
    }

    public function oderDetail($id){
        $oder = Oder::find($id);
        $user = User::where('id',$oder->user_id)->first();
        $oderDetails = OderDetail::where('oder_id',$id)->get();
         return view('admin.oders.oder_detail',compact('user','oder','oderDetails'));
    }

    public function editOder($id){
        $oderDetail = OderDetail::find($id);
        return view('admin.oders.edit_status',compact('oderDetail'));
    }
    public function updateOder(Request $request,$id){
        OderDetail::WHERE('id',$id)->update([
            'status'=>$request->status,
        ]);
        return redirect()->route('admin.oder.index')->with('tb','Cập nhật trạng thái đơn hàng thành công');
    }

    public function delete(){

    }
}
