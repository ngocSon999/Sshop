<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Permission;

class PermissionController extends Controller
{
    public function index(){
        return view('admin.permissions.index');
    }

    public function create(){
        return view('admin.permissions.create');
    }
    public function store(Request $request){
        $permission = Permission::create([
            'name'=>$request->module_parent,
            'display_name'=>$request->module_parent,
            'parent_id'=>0
        ]);
        foreach ($request->module_child as $value){
            Permission::create([
                'name'=>$request->module_parent.$value,
                'display_name'=>$request->module_parent.$value,
                'parent_id'=>$permission->id,
                'key_code'=>$request->module_parent.'_'.$value
            ]);
        }
        return back();
    }
}
