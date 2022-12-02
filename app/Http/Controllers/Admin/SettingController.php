<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CheckSetting;
use App\Http\Service\admins\SettingService;

//su dung transaction

class SettingController extends Controller
{
    private $settingService;
    public function __construct(SettingService $settingService){
       $this->settingService=$settingService;
    }

    public function index(){
        $settings = $this->settingService->getList();

        return view('admin.setting.index',compact('settings'));
    }

    public function create(){
//        $this->settingService->createSetting();
        return view('admin.setting.create');
    }

    public function store(CheckSetting $request){
       $this->settingService->storeSetting($request);

        return redirect()->route('admin.setting.index');
    }


    public function edit($id){
       $setting = $this->settingService->getEditSetting($id);
        return view('admin.setting.edit',compact('setting'));

    }

    public function update(CheckSetting $request,$id){
        $this->settingService->updateSetting($request,$id);

        return redirect()->route('admin.setting.index');
    }
    public function delete($id){
       $this->settingService->deleteSetting($id);
    }
}
