<?php
namespace App\Traits;
use App\Models\Setting;
use Illuminate\Support\Facades\Log;

Trait DeleteModelTrait {
    public function deleteModelTrait($id,$model){
        try {
            $model::where('id', $id)->delete();
            return response()->json([
                'code'=>200,
                'message'=>'success'
            ],200);

        }catch(\Exception $exception){
            log::error('message: '.$exception->getMessage().'like: '.$exception->getLine());
            return response()->json([
                'code'=>500,
                'message'=>'fail'
            ],500);
        }
    }

}
