<?php
namespace App\Http\Service\admins;


use App\Components\Recusive;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Tag;
use App\Traits\DeleteModelTrait;
use App\Traits\storageTrait;
use Illuminate\Support\Facades\Auth;

class ProductService {
    use storageTrait;
    use DeleteModelTrait;
    public function getList(){
        return Product::paginate(5);
    }

    public function createProduct($parentId){
        return $this->getCategory($parentId);
    }

    public function storeProduct($request)
    {
        $numberPrice = filter_var($request->price,FILTER_SANITIZE_NUMBER_INT);
        $dataProduct = [
            'name'=>$request->name,
            'price'=>$numberPrice,
            'content'=>$request->contents,
            'user_id'=>Auth::id(),
            'category_id'=>$request->category_id,
        ];
        $dataUploadImg = $this->storageTraitUpload($request,'feature_image_path','product');
//           dd($dataUploadImg);
        if(!empty($dataUploadImg)){
            $dataProduct['feature_image_name']=$dataUploadImg['file_name'];
            $dataProduct['feature_image_path']=$dataUploadImg['file_path'];
        }
        $product = Product::create($dataProduct);

//        insert data productImage
        if($request->hasFile('image_path')){
            $files =$request->file('image_path');

            foreach ($files as $fileItem){
                $imageDetail =  $this->storageTraitUploadMulti($fileItem,'product/imageList');
                $product->images()->create([
                    'image_path'=>$imageDetail['file_path'],
                    'image_name'=>$imageDetail['file_name'],
                ]);
            }
        }

        if(!empty($request->tags)){
            foreach ($request->tags as $tagItem){
                $tagIntance=Tag::firstOrCreate(['name'=>$tagItem]);
                $tagIds[]=$tagIntance->id;
            }
            $product->tags()->attach($tagIds);
        }
    }

    public function getCategory($parentId){
        $data =Category::all();
        $recusive = new Recusive($data);
        $htmlOption = $recusive->categoryRecusive($parentId);

        return $htmlOption;
    }

    public function getEditProduct($product)
    {
        $categoryId=$product->category_id;
        return $this->getCategory($categoryId);
    }

    public function updateProduct($request,$id)
    {

        $dataProductUpdate = [
            'name'=>$request->name,
            'price'=>$request->price,
            'content'=>$request->contents,
            'user_id'=>Auth::id(),
            'category_id'=>$request->category_id,
        ];
        $dataUploadImg = $this->storageTraitUpload($request,'feature_image_path','product');
        if(!empty($dataUploadImg)){
            $dataProductUpdate['feature_image_name']=$dataUploadImg['file_name'];
            $dataProductUpdate['feature_image_path']=$dataUploadImg['file_path'];
        }
        Product::find($id)->update($dataProductUpdate);
        $product = Product::find($id);

        //        insert data productImage
        if($request->hasFile('image_path')){
            ProductImage::where('product_id',$id)->delete();
            $files =$request->file('image_path');
            foreach ($files as $fileItem){
                $imageDetail=  $this->storageTraitUploadMulti($fileItem,'product/imageList');

                $product->images()->create([//trỏ tới pt trung gian với bảng productimage
                    'image_path'=>$imageDetail['file_path'],
                    'image_name'=>$imageDetail['file_name'],
                ]);
            }
        }
        //insert tags for product bang 2 cach
        if(!empty($request->tags)){

            foreach ($request->tags as $tagItem){
                $tagIntance=Tag::firstOrCreate(['name'=>$tagItem]);
                $tagIds[]=$tagIntance->id;
            }
            $product->tags()->sync($tagIds);
        }
    }

    public function deleteProduct($id)
    {
        return $this->deleteModelTrait($id, Product::class);
    }
}
