<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Service\admins\RoleService;
use Illuminate\Http\Request;

class RolesController extends Controller
{
    private $roleService;
    public function __construct(RoleService $roleService){
        $this->roleService=$roleService;
    }

    public function index(){
        $roles = $this->roleService->getList();
        return view('admin.roles.index', compact('roles'));
    }

    public function create(){
        $permissionsParent = $this->roleService->createRole();
        return view('admin.roles.create',compact('permissionsParent'));
    }

    public function store(Request $request){
        $this->roleService->storeRole($request);

        return redirect()->route('admin.roles.index');
    }

    public function edit($id){
        $data = $this->roleService->getEditRole($id);
        list($role,$permissionsChecked,$permissionsParent)=$data;

        return view('admin.roles.edit',compact('role','permissionsChecked','permissionsParent'));
    }

    public function update(Request $request,$id){
        $this->roleService->updateRole($request,$id);
        return redirect()->route('admin.roles.index');
    }
    public function delete($id){
        $this->roleService->deleteRole($id);
    }

}
