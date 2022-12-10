<?php
namespace App\Http\Service\admins;

use App\Http\Requests\Admin\CheckUser;
use App\Models\Role;
use App\Models\User;
use App\Traits\DeleteModelTrait;
use Illuminate\Support\Facades\Storage;

class UserService{

    use DeleteModelTrait;
    public function getList(){
        return User::paginate(5);
    }

    public function createUser(){
        return $roles = Role::all();
    }

    public function storeUser(CheckUser $request){
        $dataUser['name']  = $request->name;
        $dataUser['email']  = $request->email;
        $dataUser['password']  = bcrypt($request->password);
        if ($request->hasFile('user_image_path')){
            $file = $request->file('user_image_path');
            if (!empty($file)){
                $file_name = $file->getClientOriginalName();
                $ext = $file->extension();
                $filesize = $file->getSize();
                if(strcasecmp($ext,'jpg') == 0 || strcasecmp($ext,'jpeg') == 0
                    || strcasecmp($ext,'png') == 0){
                    if($filesize < 7000000){
                        $filepath = $file->storeAs('public/Users/',$file_name);
                    }
                    $file_path = storage::url($filepath);
                    $dataUser['user_image_path']  =$file_path;
                }
            }
        }else{
            $dataUser['user_image_path']  ='/storage/Users/AVT.jpg';
        }
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

    public function updateUser(CheckUser $request,$id){
        $dataUser['name']  = $request->name;
        $dataUser['email']  = $request->email;
        $dataUser['password']  = bcrypt($request->password);
        if ($request->hasFile('user_image_path')){
            $file = $request->file('user_image_path');
            if (!empty($file)){
                $file_name = $file->getClientOriginalName();
                $ext = $file->extension();
                $filesize = $file->getSize();
                if(strcasecmp($ext,'jpg') == 0 || strcasecmp($ext,'jpeg') == 0
                    || strcasecmp($ext,'png') == 0){
                    if($filesize < 7000000){
                        $filepath = $file->storeAs('public/Users/',$file_name);
                    }
                    $file_path = storage::url($filepath);
                    $dataUser['user_image_path'] = $file_path;
                }
            }
        }
        User::find($id)->update($dataUser);
        $user =User::find($id);
        $roleIds=$request->role_id;
        $user->roles()->sync($roleIds);
    }

    public function deleteUser($id){
        return $this->deleteModelTrait($id,User::class);
    }
}
