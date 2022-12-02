<?php
namespace App\Http\Service\admins;

use App\Models\Role;
use App\Models\User;
use App\Traits\DeleteModelTrait;

class UserService{

    use DeleteModelTrait;
    public function getList(){
        return User::paginate(5);
    }

    public function createUser(){
        return $roles = Role::all();
    }

    public function storeUser($request){
        $dataUser = [
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>bcrypt($request->password),
        ];

        $user = User::create($dataUser);
        $roleIds=$request->role_id;
        $user->roles()->attach($roleIds);
    }

    public function getEditUser($id){
        $roles = Role::all();
        $user = User::find($id);
        $roleUser = $user->roles()->get();
        return [$user, $roles,$roleUser];
    }

    public function updateUser($request,$id){
        $dataUser = [
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>bcrypt($request->password),
        ];

        User::find($id)->update($dataUser);
        $user =User::find($id);
        $roleIds=$request->role_id;
        $user->roles()->sync($roleIds);
    }

    public function deleteUser($id){
        return $this->deleteModelTrait($id,User::class);
    }
}
