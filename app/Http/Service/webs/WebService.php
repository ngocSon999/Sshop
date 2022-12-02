<?php

namespace App\Http\Service\webs;

use App\Models\Category;
use App\Models\Product;
use App\Models\Setting;
use App\Models\Slider;
use Hamcrest\Core\Set;
use DB;

class WebService
{

    private $htmlSelect = '';

    public function getAll($request)
    {
        DB::enableQuerylog();
        $sliders = Slider::all();
        $categories = Category::WHERE('parent_id', 0)->get();

        $products = DB::table('products')
            ->select('products.*');
        $sortype='asc';
        if (!empty($request->price)) {
            $sortype = $request->price;
        }
        $products = $products->orderBy('products.price', $sortype);

        if (!empty($request->category_id)) {
            $products = $products->where('category_id', $request->category_id);
        }

        if (!empty($request->keywords)) {
            $keywords = $request->keywords;
            $products = $products->where(function ($query) use ($keywords) {
                $query->orwhere('name', 'like', '%' . $keywords . '%');
                $query->orwhere('price', 'like', '%' . $keywords . '%');
                $query->orwhere('content', 'like', '%' . $keywords . '%');
            });
        }

        if (!empty($request->keywords1)) {
            $keywords = $request->keywords1;
            $products = $products->where(function ($query) use ($keywords) {
                $query->orwhere('name', 'like', '%' . $keywords . '%');
                $query->orwhere('price', 'like', '%' . $keywords . '%');
                $query->orwhere('content', 'like', '%' . $keywords . '%');
            });
        }

        $products = $products->paginate(6)->withQueryString();

        $productRecommended = Product::take(12)->get();
        $settings = Setting::all();
        $htmlSelect = $this->categorySearch();

        $sql = DB::getQuerylog();

        return [$sliders, $categories, $products, $productRecommended, $settings, $htmlSelect];
    }

    function categorySearch($id = 0, $text = '')
    {
        $data = Category::all();
        foreach ($data as $value) {
            if ($value['parent_id'] == $id) {
                $this->htmlSelect .= "<option value='" . $value['id'] . "'>" . $text . $value['name'] . "</option>";

                $this->categorySearch($value['id'], $text . '-');
            }
        }
        return $this->htmlSelect;
    }
}
