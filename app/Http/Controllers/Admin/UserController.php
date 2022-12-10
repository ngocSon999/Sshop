<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CheckUser;
use App\Http\Service\admins\UserService;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private $userService;
    public function __construct(UserService $userService){
    $this->userService=$userService;

    }
    public function index(){
        $userList =$this->userService->getList();

        return view('admin.user.index',compact('userList'));
    }

    public function create(){
       $roles = $this->userService->createUser();

        return view('admin.user.create',compact('roles'));
    }

    public function store(CheckUser $request){
        $this->userService->storeUser($request);

        return redirect()->route('admin.user.index');
    }

    public function edit(Request $request,$id){
        $dataUser = $this->userService->getEditUser($id);
        list($user,$roles,$roleUser) = $dataUser;

        return view('admin.user.edit',compact('user','roles','roleUser'));
    }

    public function update(CheckUser $request,$id){
       $this->userService->updateUser($request,$id);

        return redirect()->route('admin.user.index');
    }

    public function delete(Request $request){
        $id = $request->user_id;
       $this->userService->deleteUser($id);
    }
}
