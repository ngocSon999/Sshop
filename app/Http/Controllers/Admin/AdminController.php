<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{

    public function index(){
       return view('admin.login.index');
    }

    public function CheckLogin(Request $request){
        $data=[
            'email'=>$request->email,
            'password'=>$request->password
        ];
        $remember = $request->has('remember_me') ? true : false;
        if(Auth::attempt($data,$remember)){
            return redirect()->to('home');
        }else{
            return back()->with('tb','Vui lòng đăng nhập');
        }
    }

    public function logout(){
        Auth::logout();
        return redirect()->route('admin.login');
    }
}
