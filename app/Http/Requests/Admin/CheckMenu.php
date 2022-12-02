<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Request;

class CheckMenu extends FormRequest
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

        $uniqueCategoryName = 'unique:categories';
        if(!empty($id)){
            $uniqueCategoryName ='unique:categories,name,'.$id;
        }
        return [
            'name'=>'required|max:100|'.$uniqueCategoryName
        ];
    }
    public function messages()
    {

        return [
            'name.required'=>'Tên danh mục bắt buộc phải nhập',
            'name.unique'=>'Tên danh mục đã tồn tại trên hệ thống',
            'name.max'=>'Tên danh mục không được lớn hơn :max ký tự'
        ];
    }
}
