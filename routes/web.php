<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\MenusController;
use App\Http\Controllers\Admin\ProductController;

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\RolesController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Web\WebController;
use App\Http\Controllers\Web\ContactController;

//-----------------------------------------------

Route::get('/home', function () {
    return view('admin.home');
})->name('admin.home');




Route::prefix('admin')->group(function (){
    Route::get('/login',[AdminController::class,'index'])->name('admin.login');
    Route::post('/CheckLogin',[AdminController::class,'CheckLogin'])->name('admin.CheckLogin');
});

Route::prefix('admin')->group(function (){
    Route::get('/logout',[AdminController::class,'logout'])->name('admin.logout');


   Route::prefix('category')->group(function (){
       Route::get('/',[CategoryController::class,'index'])->name('admin.category.index')->middleware('can:category_list');

       Route::get('/create',[CategoryController::class,'create'])->name('admin.category.create')->middleware('can:category_add');
       Route::post('/store',[CategoryController::class,'store'])->name('admin.category.store');

       Route::get('/edit/{id}',[CategoryController::class,'edit'])->name('admin.category.edit')->middleware('can:category_edit');
       Route::post('/update/{id}',[CategoryController::class,'update'])->name('admin.category.update');

       Route::get('/delete/{id}',[CategoryController::class,'delete'])->name('admin.category.delete')->middleware('can:category_delete');
   });

    Route::prefix('menu')->group(function (){
        Route::get('/',[MenusController::class,'index'])->name('admin.menu.index')->middleware('can:menus_list');

        Route::get('/create',[MenusController::class,'create'])->name('admin.menu.create')->middleware('can:menus_add');
        Route::post('/store',[MenusController::class,'store'])->name('admin.menu.store');

        Route::get('/edit/{id}',[MenusController::class,'edit'])->name('admin.menu.edit')->middleware('can:menus_edit');
        Route::post('/update/{id}',[MenusController::class,'update'])->name('admin.menu.update');

        Route::get('/delete/{id}',[MenusController::class,'delete'])->name('admin.menu.delete')->middleware('can:menus_delete');
    });

    Route::prefix('product')->group(function (){
        Route::get('/',[ProductController::class,'index'])->name('admin.product.index')->middleware('can:product_list');

        Route::get('/create',[ProductController::class,'create'])->name('admin.product.create')->middleware('can:product_add');
        Route::post('/store',[ProductController::class,'store'])->name('admin.product.store');

        Route::get('/edit/{product}',[ProductController::class,'edit'])->name('admin.product.edit')->middleware('can:product_edit');
        Route::post('/update/{id}',[ProductController::class,'update'])->name('admin.product.update');

        Route::get('/delete/{id}',[ProductController::class,'delete'])->name('admin.product.delete')->middleware('can:product_delete');
    });

    Route::prefix('slider')->group(function (){
        Route::get('/',[SliderController::class,'index'])->name('admin.slider.index')->middleware('can:slider_list');

        Route::get('/create',[SliderController::class,'create'])->name('admin.slider.create')->middleware('can:slider_add');
        Route::post('/store',[SliderController::class,'store'])->name('admin.slider.store');

        Route::get('/edit/{id}',[SliderController::class,'edit'])->name('admin.slider.edit')->middleware('can:slider_edit');
        Route::post('/update/{id}',[SliderController::class,'update'])->name('admin.slider.update');

        Route::get('/delete/{id}',[SliderController::class,'delete'])->name('admin.slider.delete')->middleware('can:slider_delete');
    });

    Route::prefix('setting')->group(function (){
        Route::get('/',[SettingController::class,'index'])->name('admin.setting.index')->middleware('can:setting_list');

        Route::get('/create',[SettingController::class,'create'])->name('admin.setting.create')->middleware('can:setting_add');
        Route::post('/store',[SettingController::class,'store'])->name('admin.setting.store');

        Route::get('/edit/{id}',[SettingController::class,'edit'])->name('admin.setting.edit')->middleware('can:setting_edit');
        Route::post('/update/{id}',[SettingController::class,'update'])->name('admin.setting.update');

        Route::get('/delete/{id}',[SettingController::class,'delete'])->name('admin.setting.delete')->middleware('can:setting_delete');
    });

    Route::prefix('user')->group(function (){
        Route::get('/',[UserController::class,'index'])->name('admin.user.index');//->middleware('can:user_list');

        Route::get('/create',[UserController::class,'create'])->name('admin.user.create');//->middleware('can:user_add');
        Route::post('/store',[UserController::class,'store'])->name('admin.user.store');

        Route::get('/edit/{id}',[UserController::class,'edit'])->name('admin.user.edit')->middleware('can:user_edit');
        Route::post('/update/{id}',[UserController::class,'update'])->name('admin.user.update');

        Route::get('/delete/{id}',[UserController::class,'delete'])->name('admin.user.delete')->middleware('can:user_delete');
    });


    Route::prefix('roles')->group(function (){
        Route::get('/',[RolesController::class,'index'])->name('admin.roles.index')->middleware('can:role_list');

        Route::get('/create',[RolesController::class,'create'])->name('admin.roles.create')->middleware('can:role_add');
        Route::post('/store',[RolesController::class,'store'])->name('admin.roles.store');

        Route::get('/edit/{id}',[RolesController::class,'edit'])->name('admin.roles.edit')->middleware('can:role_edit');
        Route::post('/update/{id}',[RolesController::class,'update'])->name('admin.roles.update');

        Route::get('/delete/{id}',[RolesController::class,'delete'])->name('admin.roles.delete')->middleware('can:role_delete');
    });

    Route::prefix('permission')->group(function (){
        Route::get('/',[PermissionController::class,'index'])->name('admin.permission.index');

        Route::get('/create',[PermissionController::class,'create'])->name('admin.permission.create');
        Route::post('/store',[PermissionController::class,'store'])->name('admin.permission.store');

        Route::get('/edit/{id}',[PermissionController::class,'edit'])->name('admin.permission.edit');
        Route::post('/update/{id}',[PermissionController::class,'update'])->name('admin.permission.update');

        Route::get('/delete/{id}',[PermissionController::class,'delete'])->name('admin.permission.delete');
    });
});



Route::prefix('web')->group(function(){
    //ngươi dùng đăng ký
    Route::get('/createUser',[WebController::class,'create'])->name('web.login.index');
    Route::post('/addUser',[WebController::class,'store'])->name('web.login.store');

    //người dùng đăng nhập
    Route::get('/login',[WebController::class,'login'])->name('web.login.form_login');
    Route::post('/checkLogin',[WebController::class,'checkLogin'])->name('web.checkLogin');
    //người dùng đăng xuất
    Route::get('/logout',[WebController::class,'logout'])->name('web.logout');


    Route::get('/home',[WebController::class,'index'])->name('web.home.index');
    Route::get('/product/{slug}/{id}',[WebController::class,'showCategoryProduct'])->name('web.categoryProduct');

    Route::get('/cart/{id}',[WebController::class,'getCart'])->name('web.getCart')->middleware('user.login');
    Route::get('/showCart',[WebController::class,'showCart'])->name('web.showCart');
    Route::get('/updateCart/{id}',[WebController::class,'updateCart'])->name('web.updateCart');
    Route::get('/deleteCart/{id}',[WebController::class,'deleteCart'])->name('web.deleteCart');
    // chi tiết sản phẩm
    Route::get('/product_detail/{id}',[WebController::class,'productDetail'])->name('web.productDetail');


    //lin hệ
    Route::get('/contact',[ContactController::class,'index'])->name('web.contact.index');
});
