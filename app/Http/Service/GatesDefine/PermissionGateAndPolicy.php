<?php
namespace App\Http\Service\GatesDefine;

use Illuminate\Support\Facades\Gate;

class PermissionGateAndPolicy {

    public function setGateAndPolicyAccess(){
        $this->defineGateCategory();
        $this->defineGateMenu();
        $this->defineGateProduct();
        $this->defineGateSlider();
        $this->defineGateSetting();
        $this->defineGateUser();
        $this->defineGateRole();
        $this->defineGateOder();
        $this->defineGateComment();
        $this->defineGateContact();
        $this->defineGateVideo();
    }

    public function defineGateVideo(){
        Gate::define('video_list','App\Policies\VideoPolicy@view');
        Gate::define('video_add','App\Policies\VideoPolicy@create');
        Gate::define('video_edit','App\Policies\VideoPolicy@update');
        Gate::define('video_delete','App\Policies\VideoPolicy@delete');
    }
    public function defineGateContact(){
        Gate::define('contact_list','App\Policies\ContactPolicy@view');
        Gate::define('contact_add','App\Policies\ContactPolicy@create');
        Gate::define('contact_edit','App\Policies\ContactPolicy@update');
        Gate::define('contact_delete','App\Policies\ContactPolicy@delete');
    }
    public function defineGateComment(){
        Gate::define('comment_list','App\Policies\CommentPolicy@view');
        Gate::define('comment_add','App\Policies\CommentPolicy@create');
        Gate::define('comment_edit','App\Policies\CommentPolicy@update');
        Gate::define('comment_delete','App\Policies\CommentPolicy@delete');
    }
    public function defineGateOder(){
        Gate::define('oder_list','App\Policies\OderPolicy@view');
        Gate::define('oder_add','App\Policies\OderPolicy@create');
        Gate::define('oder_edit','App\Policies\OderPolicy@update');
        Gate::define('oder_delete','App\Policies\OderPolicy@delete');
    }
    public function defineGateCategory(){
        Gate::define('category_list','App\Policies\CategoryPolicy@view');
        Gate::define('category_add','App\Policies\CategoryPolicy@create');
        Gate::define('category_edit','App\Policies\CategoryPolicy@update');
        Gate::define('category_delete','App\Policies\CategoryPolicy@delete');
    }

    public function defineGateMenu(){
        Gate::define('menus_list','App\Policies\MenuPolicy@view');
        Gate::define('menus_add','App\Policies\MenuPolicy@create');
        Gate::define('menus_edit','App\Policies\MenuPolicy@update');
        Gate::define('menus_delete','App\Policies\MenuPolicy@delete');

    }

    public function defineGateProduct(){
        Gate::define('product_list','App\Policies\ProductPolicy@view');
        Gate::define('product_add','App\Policies\ProductPolicy@create');
        Gate::define('product_edit','App\Policies\ProductPolicy@update');
        Gate::define('product_delete','App\Policies\ProductPolicy@delete');
    }

    public function defineGateSlider(){
        Gate::define('slider_list','App\Policies\SliderPolicy@view');
        Gate::define('slider_add','App\Policies\SliderPolicy@create');
        Gate::define('slider_edit','App\Policies\SliderPolicy@update');
        Gate::define('slider_delete','App\Policies\SliderPolicy@delete');
    }

    public function defineGateSetting(){
        Gate::define('setting_list','App\Policies\SettingPolicy@view');
        Gate::define('setting_add','App\Policies\SettingPolicy@create');
        Gate::define('setting_edit','App\Policies\SettingPolicy@update');
        Gate::define('setting_delete','App\Policies\SettingPolicy@delete');
    }

    public function defineGateUser(){
        Gate::define('user_list','App\Policies\UserPolicy@view');
        Gate::define('user_add','App\Policies\UserPolicy@create');
        Gate::define('user_edit','App\Policies\UserPolicy@update');
        Gate::define('user_delete','App\Policies\UserPolicy@delete');
    }

    public function defineGateRole(){
        Gate::define('role_list','App\Policies\RolePolicy@view');
        Gate::define('role_add','App\Policies\RolePolicy@create');
        Gate::define('role_edit','App\Policies\RolePolicy@update');
        Gate::define('role_delete','App\Policies\RolePolicy@delete');
    }
}
