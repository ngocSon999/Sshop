<?php
function getConfigSetting($configKey){
    $setting = \App\Models\Setting::Where('config_key',$configKey)->first();
    if(!empty($setting)){
        return $setting->config_value;
    }
    return null;
}
