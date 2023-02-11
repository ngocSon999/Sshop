<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CheckProduct;
use App\Http\Service\admins\ProductService;
use App\Models\Product;
use Yajra\DataTables\DataTables;

class ProductController extends Controller
{


    private $productService;
    public function __construct(ProductService $productService)
    {
        $this->productService=$productService;
    }

    public function index(){
        return view('admin.product.index');
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

    public function getDataProduct (){
        $products = Product::select([
            'id',
            'name',
            'price',
            'feature_image_path',
            'category_id'
        ]);
        return DataTables::of($products->get())
            ->editColumn('feature_image_path', function(Product $product){
                return sprintf(
                    '<img src="%s" width="150px" height="150px" alt="">',
                            asset($product->feature_image_path)
                );
            })
            ->editColumn('category_id', function (Product $product){
                return $product->category->name;
            })
            ->addColumn('actions', function ($product) {
                return view('admin.product.actions', ['row' => $product])->render();
            })
            ->rawColumns(['actions','feature_image_path'])
            ->make(true);
    }
}
