<?php
namespace App\Traits;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

trait storageTrait{
    public function storageTraitUpload($request,$fieldName,$folderName){
        if($request->hasFile($fieldName)){
            $file = $request->file($fieldName);
            $file_name = $file->getClientOriginalName();
            $ext = $file->extension();
            $filesize = $file->getSize();
            if(strcasecmp($ext,'jpg') == 0 || strcasecmp($ext,'jpeg') == 0
                || strcasecmp($ext,'png') == 0){
                $image='product-'.$file_name;
                if($filesize < 7000000){
                    $filepath = $file->storeAs('public/'.$folderName.'/'.Auth::id(),$image);
                }
                $dataUploadTrait = [
                    'file_name'=>$file_name,
                    'file_path'=>storage::url($filepath),
                ];
                return $dataUploadTrait;
            }
        };
        return null;
    }

    public function storageTraitUploadMulti($file,$folderName){
            $file_name = $file->getClientOriginalName();
            $ext = $file->extension();
            if(strcasecmp($ext,'jpg') == 0 || strcasecmp($ext,'jpeg') == 0
                || strcasecmp($ext,'png') == 0){
                $image='product-'.$file_name;
                $filepath = $file->storeAs('public/'.$folderName.'/'.Auth::id(),$image);
                $dataUploadTrait = [
                    'file_name'=>$file_name,
                    'file_path'=>storage::url($filepath),
                ];
                return $dataUploadTrait;
            }
        return null;
    }
}
