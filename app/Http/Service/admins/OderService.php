<?php
namespace App\Http\Service\admins;



use App\Models\Oder;
use DB;

class OderService {
    public function getList(){
        $oderList = \DB::table('oders')
            ->join('oder_details','oders.id','=','oder_details.oder_id')
            ->select('oder_details.*','oders.*')
            ->orderBy('oders.id','desc')
            ->paginate(20);
        return $oderList;
    }
}
