<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Service\webs\WebService;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use http\Env\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\CheckUser;

class WebController extends Controller
{
    private $webService;
    public function __construct(WebService $webService)
    {
        $this->webService = $webService;
    }

    public function create(){
        return view('web.login.index');
    }

    public function store(CheckUser $request){
        User::create([
            'name'=>$request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);
        return  redirect()->route('web.login.form_login');
    }

    public function login(){
        return view('web.login.form_login');
    }

    public function checkLogin(Request $request){
        $data = [
          'email'=>$request->email,
          'password'=>$request->password
        ];
        if (Auth::attempt($data)){
            return redirect()->route('web.home.index');
        }else{
            return back()->with('tb','Thông tin đăng nhập không chính xác');
        }
    }

    public function logout(){
        Auth::logout();
        return redirect()->route('web.home.index');
    }


    public function index(request $request)
    {


        $data = $this->webService->getAll($request);
        list($sliders, $categories, $products, $productRecommended, $settings,$htmlSelect) = $data;

        return view('web.home.index',
            compact(
                'sliders',
                'categories',
                'products',
                'productRecommended',
                'settings',
                'htmlSelect'
            ));
    }

    public function showCategoryProduct(Request $request,$slug, $category_id){
        $categories = Category::WHERE('parent_id',0)
            ->get();
        $products=Product::WHERE('category_id',$category_id);
        if (!empty($request->kewords1)){
            $keywords = $request->kewords1;

        $products=$products->where(function ($query) use($keywords){
            $query->orwhere('name', 'like', '%' . $keywords . '%');
            $query->orwhere('price', 'like', '%' . $keywords . '%');
            $query->orwhere('content', 'like', '%' . $keywords . '%');
        });
        }
        $products=$products->paginate(12);
        return view('web.home.categoryProduct',compact('categories','products'));
    }



    public function getCart($id){
    $product = Product::find($id);
    $cart=session()->get('carts');
    if(isset($cart[$id])){
        $cart[$id]['quantity'] = $cart[$id]['quantity'] + 1;
    }else{
        $cart[$id] = [
            'name'=>$product->name,
            'price'=>$product->price,
            'image_path'=>$product->feature_image_path,
            'quantity'=>1
        ];
    }
    session()->put('carts',$cart);
        return response()->json([
            'code'=>200,
            'message'=>'success'
        ],200);
}


    public function showCart(){
        $categories = Category::WHERE('parent_id',0)
            ->get();
        $carts = session()->get('carts');
        return view('web.home.listCart',compact('categories','carts'));
    }

    public function updateCart(Request $request,$id){
        if ($request->id && $request->quantity){
            $carts = session()->get('carts');
            $carts[$id]['quantity'] = $request->quantity;
            session()->put('carts',$carts);
            $carts = session()->get('carts');
            $cartComponent = view('web.components.show_cart',compact('carts'))->render();
            return response()->json(['cart_component'=>$cartComponent, 'code'=>200],200);
        }


    }

    public function deleteCart($id){
        if (!empty($id)){
            $carts = session()->get('carts');
            unset($carts[$id]);
            session()->put('carts',$carts);
            $carts = session()->get('carts');
            $cartComponent = view('web.components.show_cart',compact('carts'))->render();
            return response()->json(['cart_component'=>$cartComponent, 'code'=>200],200);
        }

    }

    public function productDetail($id){
        $categories = Category::WHERE('parent_id',0)
            ->get();
        $product = Product::find($id);
        return view('web.home.product_detail',compact('categories','product'));
    }
}
