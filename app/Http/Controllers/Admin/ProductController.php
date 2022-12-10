<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CheckProduct;
use App\Http\Service\admins\ProductService;
use App\Models\Product;

class ProductController extends Controller
{


    private $productService;
    public function __construct(ProductService $productService)
    {
        $this->productService=$productService;
    }

    public function index(){
        $productList =  $this->productService->getList();
        return view('admin.product.index',compact('productList'));
    }

    public function create($parentId = ''){
        $htmlOption = $this->productService->createProduct($parentId);

        return view('admin.product.create',compact('htmlOption'));
    }

    public function store(CheckProduct $request){
        $this->productService->storeProduct($request);

        return redirect()->route('admin.product.index');
    }


    public function edit(Product $product){
        $htmlOption=$this->productService->getEditProduct($product);

        return view('admin.product.edit',compact('product','htmlOption'));
    }

    public function update(CheckProduct $request,$id){
        $this->productService->updateProduct($request,$id);

        return redirect()->route('admin.product.index');
    }

    public function delete($id){

        return $this->productService->deleteProduct($id);
    }
}
