<?php

namespace App\Http\Requests\Admin;

use App\Models\Slider;
use Illuminate\Foundation\Http\FormRequest;

use Illuminate\Validation\Rule;
use Symfony\Component\HttpFoundation\Request;

class CheckSlider extends FormRequest
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
        $slider ='';
        $id = $request->route('id');
        $sliderUnique = 'unique:sliders';
        if (!empty($id)) {
            $sliderUnique = 'unique:sliders,name,' . $id;
            $slider = Slider::find($id);
        }



        return [
            'name' => 'required|max:150|' . $sliderUnique,
            'description' => 'required|max:300',
            'image_path' => Rule::requiredIf(function () use ($slider) {
                if ($slider && $slider->image_path) {
                    return false;
                } else {
                    return true;
                }
            }),
        ];
    }

    public function messages()
    {
        return [
            'name.required' => ':attribute bắt buộc phải nhập',
            'name.max' => ':attribute không được quá :max ký tự',
            'name.unique' => ':attribute đã tồn tại trên hệ thống',
            'description.required' => ':attribute bắt buộc phải nhập',
            'description.max' => ':attribute không được quá :max ký tự',
            'image_path.required' => ':attribute bắt buộc phải nhập',
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'Tên slider',
            'description' => 'Nội dung mô tả',
            'image_path' => ' Hình ảnh'
        ];
    }
}
