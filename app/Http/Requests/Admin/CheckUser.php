<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Request;

class CheckUser extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(Request $request)
    {
        $id = $request->route('id');
        $userUnique='unique:users';
        if (!empty($id)){
            $userUnique = 'unique:users,email,'.$id;
        }
        return [
            'name'=>'required|max:50',
            'email'=>'required|email|'.$userUnique,
            'password'=>'required|min:6|max:32'
        ];
    }

    public function messages()
    {
        return [
            'name.required'=>':attribute bắt buộc phải nhập',
            'name.max'=>':attribute không được vượt quá :max ký tự',
            'email.required'=>':attribute bắt buộc phải nhập',
            'email.email'=>':attribute không đúng định dạng',
            'email.unique'=>':attribute đã tồn tại trên hệ thống',
            'password.required'=>':attribute bắt buộc phải nhập',
            'password.min'=>':attribute không được nhỏ hơn :min ký tự',
            'password.max'=>':attribute không được vượt quá :max ký tự',
        ];
    }

    public function attributes()
    {
        return[
          'name'=>'Tên',
          'email'=>'email',
          'password'=>'Mật khẩu'
        ];
    }
}
