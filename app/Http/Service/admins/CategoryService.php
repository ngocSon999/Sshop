<?php
namespace App\Http\Service\admins;

use App\Components\Recusive;
use App\Models\Category;
use Illuminate\Support\Str;

class CategoryService{
    public function getList(){
        return Category
            ::paginate(10);
    }



    public function getCategory($parentId){
        $data =Category::all();
        $recusive = new Recusive($data);
        $htmlOption = $recusive->categoryRecusive($parentId);
        return $htmlOption;
    }

    public function storeData($request){
        $data = [
            'name'=>$request->name,
            'parent_id'=>$request->parent_id,
            'slug'=>Str::slug($request->name)
        ];
        Category::create($data);
    }

    public function getEdit($id){
        $category = Category::find($id);
        $htmlOption = $this->getCategory($category->parent_id);

        return [$category,$htmlOption];
    }

    public function updateCategory($request, $id){
        $updateCategory = [
            'name'=>$request->name,
            'parent_id'=>$request->parent_id,
            'slug'=>Str::slug($request->name)
        ];
        Category::where('id',$id)->update($updateCategory);
    }

    public function deleteCategory($id){
        Category::where('id',$id)->delete();
    }
}
