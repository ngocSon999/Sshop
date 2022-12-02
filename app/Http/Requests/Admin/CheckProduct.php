<?php

namespace App\Http\Requests\Admin;

use App\Models\Product;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Request;
use Illuminate\Validation\Rule;
class CheckProduct extends FormRequest
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
        $product = '';
        $productImg = '';
       if (!empty($id)){
           $product = Product::find($id);
           $productImg = $product->images()->get();
       }
        return [
            'name'=>'required|max:255|unique:products,name,'.$id,
            'price'=>'required|integer',
            'feature_image_path'=>Rule::requiredIf(function () use ($product) {
                if($product && $product->feature_image_path){
                    return false;
                }else{
                    return true;
                }
            }),
            'image_path'=>Rule::requiredIf(function () use ($productImg) {
                if($productImg){
                    return false;
                }else{
                    return true;
                }
            }),
            'category_id'=>['required', function($attribute, $value, $fail){
                if(empty($value)){
                    $fail('Vui lòng chọn danh mục cho sản phẩm');
                }
            }],
            'tags'=>'required',
            'contents'=>'required',
        ];
    }
    public function messages()
    {
        return [
            'name.required'=>':attribute bắt buộc phải nhập',
            'name.unique'=>':attribute đã tồn tại trên hệ thống',
            'name.max'=>':attribute không được vượt quá :max ký tự',
            'price.required'=>':attribute bắt buộc phải nhập',
            'price.integer'=>':attribute phải là số',
            'feature_image_path.required'=>':attribute bắt buộc phải nhập',
            'image_path.required'=>':attribute bắt buộc phải nhập',
            'category_id.required'=>':attribute bắt buộc phải chọn',
            'tags.required'=>':attribute bắt buộc phải nhập',
            'contents.required'=>':attribute bắt buộc phải nhập',
        ];
    }
    public function attributes()
    {
        return [
            'name'=>'Tên sản phẩm',
            'price'=>'Giá sản phẩm',
            'feature_image_path'=>'Ảnh đại diện cho sản phẩm',
            'image_path'=>'ảnh chi tiết cho sản phẩm',
            'category_id'=>'Danh mục sản phẩm',
            'tags'=>'Tags cho sản phẩm',
            'contents'=>'Nội dung mô tả cho sản phẩm',
        ];
    }
}
