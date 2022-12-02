<?php
namespace App\Http\Service\admins;

use App\Models\Setting;
use App\Traits\DeleteModelTrait;

class SettingService {
    use DeleteModelTrait;
    public function getList(){
        return Setting::paginate(5);
    }

    public function createSetting(){
        return view('admin.setting.create');
    }

    public function storeSetting($request){
        $dataSetting = [
            'config_key'=>$request->config_key,
            'config_value'=>$request->config_value,
            'type'=>$request->type,
        ];
        Setting::create($dataSetting);
    }

    public function getEditSetting($id){
       return Setting::find($id);
    }

    public function updateSetting($request,$id){
        $dataSetting = [
            'config_key'=>$request->config_key,
            'config_value'=>$request->config_value,
        ];
        Setting::find($id)->update($dataSetting);
    }

    public function deleteSetting($id){
        return $this->deleteModelTrait($id,Setting::class);
    }
}
