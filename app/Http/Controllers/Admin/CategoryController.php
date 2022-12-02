<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CheckCategory;
use App\Http\Service\admins\CategoryService;
use App\Models\Category;

//check form request
//file đệ quy

class CategoryController extends Controller
{
    /**
     * @var CategoryService;
     */

    private $category;
    private $categoryService;
    public function __construct(Category $category,CategoryService $categoryService)
    {
        $this->category=$category;
        $this->categoryService=$categoryService;
    }


    public function index(){
        $categories=$this->categoryService->getList();

        return view('admin.category.index', compact('categories'));
    }

    public function create($parentId = ''){
        $htmlOption = $this->categoryService->getCategory($parentId);

        return view('admin.category.create',compact('htmlOption'));
    }


    public function store(CheckCategory $request){
        $this->categoryService->storeData($request);

        return redirect()->route('admin.category.index');
    }



    public function edit($id){
        $data=$this->categoryService->getEdit($id);
        list($category, $htmlOption) = $data;

        return view('admin.category.edit',compact('category','htmlOption'));
    }

    public function update(CheckCategory $request,$id){

        $this->categoryService->updateCategory($request,$id);

        return redirect()->route('admin.category.index')->with('tb','update thành công');
    }

    public function delete($id){
        $this->categoryService->deleteCategory($id);
        return back()->with('tb','Xóa thành công');
    }

//    public function restGet()/APIIIIIIIIIIII
//    {
//        return response()->json(Category::all());
//    }
}
