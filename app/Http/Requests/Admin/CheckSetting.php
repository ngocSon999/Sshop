<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

use Illuminate\Validation\Rule;
use Symfony\Component\HttpFoundation\Request;

class CheckSetting extends FormRequest
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
        $configKeyUnique = 'unique:settings';
        $configValueUnique = 'unique:settings';
        $id =$request->route('id');
        if(!empty($id)){
            $configKeyUnique= 'unique:settings,config_key,'.$id;
            $configValueUnique= 'unique:settings,config_value,'.$id;
        }

        return [
            'config_key'=>'required|max:200|'.$configKeyUnique,
            'config_value'=>'required|'.$configValueUnique,

        ];
    }
    public function messages()
    {
        return [
            'config_key.required'=>':attribute bắt buộc phải nhập',
            'config_key.max'=>':attribute không được quá :max ký tự',
            'config_key.unique'=>':attribute đã tồn tại trên hệ thống',

            'config_value.unique'=>':attribute đã tồn tại trên hệ thống',
            'config_value.required'=>':attribute bắt buộc phải nhập',
        ];
    }
    public function attributes()
    {
        return [
            'config_key'=>'config_key',
            'config_value'=>'config_value',
        ];
    }
}
