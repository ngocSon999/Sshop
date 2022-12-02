<?php
namespace App\Http\Service\admins;

use App\Models\Permission;
use App\Models\Role;
use App\Traits\DeleteModelTrait;

class RoleService{
    use DeleteModelTrait;

    public function getList()
    {
        return Role::paginate(10);
    }

    public function createRole(){
        return Permission::where('parent_id',0)->get();
    }

    public function storeRole($request){
        $role = Role::create([
            'name'=>$request->name,
            'display_name'=>$request->display_name,
        ]);

        $role->permissionRoles()->attach($request->permission_id);
    }

    public function getEditRole($id){
        $role = Role::find($id);
        $permissionsChecked = $role->permissionRoles()->get();
        $permissionsParent = Permission::where('parent_id',0)->get();
        return [$role,$permissionsChecked,$permissionsParent];
    }

    public function updateRole($request,$id){
        Role::find($id)->update([
            'name'=>$request->name,
            'display_name'=>$request->display_name,
        ]);
        $role=Role::find($id);
        $role->permissionRoles()->sync($request->permission_id);
    }

    public function deleteRole($id){
        return $this->deleteModelTrait($id,Role::class);
    }
}

