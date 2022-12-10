<?php

namespace App\Http\Requests\Web;

use Illuminate\Foundation\Http\FormRequest;

class CheckOut extends FormRequest
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
    public function rules()
    {
        return [
            'name' => 'required|max:50',
            'email' =>'required|max:100',
            'address' =>'required|max:255',
            'phone' =>'required|max:20',
            'note' => 'max:255',
            'pay_method' =>'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => ':attribute bắt buôc phải nhập',
            'email.required' =>':attribute bắt buôc phải nhập',
            'email.email' =>':attribute không đúng định dạng',
            'email.max' =>':attribute không được vượt quá :max ký tự',
            'address.required' =>':attribute bắt buôc phải nhập',
            'address.max' =>':attribute không được vượt quá :max ký tự',
            'phone.required' =>':attribute bắt buôc phải nhập',
            'phone.max' =>':attribute không được vượt quá :max ký tự',
            'note.max' => ':attribute không được vượt quá :max ký tự',
            'pay_method.required' => 'Vui lòng chọn :attribute',

        ];
    }

    public function attributes()
    {
        return [
            'name' => 'Tên người nhận hàng',
            'email' =>'Email',
            'address' =>'Địa chỉ',
            'phone' =>'Số điện thoại',
            'note' => 'Nội dung ghi chú',
            'pay_method' => 'Hình thức thanh toán',
        ];
    }
}
