<?php
namespace App\Traits;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Setting;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
Trait DeleteModelTrait {
    public function deleteModelTrait($id,$model){
        if ($model = Product::class){
            $product = Product::find($id);
            $productImg = $product->images;
            \Storage::delete($product->feature_image_path);
            foreach ($productImg as $item){
                \Storage::delete($item->image_path);
                ProductImage::where('id',$item->id)->delete();
            }
            $product->delete();
        }else{
            $model::where('id', $id)->delete();
        }

        return \response()->json([
            'code'=>200,
            'message'=>'success'
        ],200);

//        try {
//            $model::where('id', $id)->delete();
//            return \response()->json([
//                'code'=>200,
//                'message'=>'success'
//            ],200);
//
//        }catch(\Exception $exception){
//            log::error('message: '.$exception->getMessage().'like: '.$exception->getLine());
//            return response()->json([
//                'code'=>500,
//                'message'=>'fail'
//            ],500);
//        }
    }

}
