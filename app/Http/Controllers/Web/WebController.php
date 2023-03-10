<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Service\webs\WebService;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Oder;
use App\Models\Ratting;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\CheckUser;
use DB;
use  App\Http\Requests\Web\CheckOut;
use Illuminate\Support\Facades\Storage;


class WebController extends Controller
{
    private $webService;

    public function __construct(WebService $webService)
    {
        $this->webService = $webService;
    }

    public function create()
    {
        return view('web.login.index');
    }

    public function store(CheckUser $request)
    {
        if ($request->hasFile('user_image_path')){
            $file = $request->file('user_image_path');
            if (!empty($file)){
                $file_name = $file->getClientOriginalName();
                $ext = $file->extension();
                $filesize = $file->getSize();
                if(strcasecmp($ext,'jpg') == 0 || strcasecmp($ext,'jpeg') == 0
                    || strcasecmp($ext,'png') == 0){
                    if($filesize < 7000000){
                        $filepath = $file->storeAs('public/Users/',$file_name);
                    }
                    $file_path = storage::url($filepath);
                }
                User::create([
                    'name' => $request->name,
                    'user_image_path'=>$file_path,
                    'email' => $request->email,
                    'password' => bcrypt($request->password),
                ]);
            }
        }else{
            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'user_image_path'=>'/storage/Users/AVT.jpg',
                'password' => bcrypt($request->password),
            ]);

        }
        return redirect()->route('web.login.form_login')->with('tb','????ng k?? th??nh c??ng, vui l??ng ????ng nh???p l???i');
    }

    public function login()
    {
        return view('web.login.form_login');
    }

    public function checkLogin(Request $request)
    {
        $data = [
            'email' => $request->email,
            'password' => $request->password
        ];
        $remember = $request->has('remember_me') ? true : false;
        if (Auth::attempt($data,$remember)) {
            return redirect()->route('web.home.index');
        } else {
            return back()->with('tb', 'Th??ng tin ????ng nh???p kh??ng ch??nh x??c');
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('web.home.index');
    }

        //show trang ch???
    public function index(Request $request)
    {
        $data = $this->webService->getAll($request, $slug = '');
        list($sliders, $categories, $products, $productRecommended, $settings, $htmlSelect,$videos) = $data;

        return view('web.home.index',
            compact(
                'sliders',
                'categories',
                'products',
                'productRecommended',
                'settings',
                'htmlSelect',
                'videos'
            ));
    }

    public function showCategoryProduct(Request $request, $slug, $category_id)
    {
        $categories = Category::WHERE('parent_id', 0)
            ->get();
        $products = Product::WHERE('category_id', $category_id);
        if (!empty($request->kewords1)) {
            $keywords = $request->kewords1;

            $products = $products->where(function ($query) use ($keywords) {
                $query->orwhere('name', 'like', '%' . $keywords . '%');
                $query->orwhere('price', 'like', '%' . $keywords . '%');
                $query->orwhere('content', 'like', '%' . $keywords . '%');
            });
        }
        $products = $products->paginate(12);
        return view('web.home.categoryProduct', compact('categories', 'products'));
    }


    public function getCart(Request $request, $id)
    {
        $qantityProduct = 1;
        if ($request->productQuantity){
            $qantityProduct = $request->productQuantity;
        }
        $product = Product::find($id);
        $cart = session()->get('carts');
        if (isset($cart[$id])) {
            $cart[$id]['quantity'] = $cart[$id]['quantity'] + $qantityProduct;
        } else {
            $cart[$id] = [
                'name' => $product->name,
                'price' => $product->price,
                'image_path' => $product->feature_image_path,
                'quantity' => $qantityProduct,
            ];
        }
        session()->put('carts', $cart);
        return response()->json([
            'code' => 200,
            'message' => 'success',
        ], 200);
    }

    public function getQuickCart(Request $request)
    {
        $id = $request->idProduct;
        $qantityProduct = $request->productQuantity;
        $product = Product::find($id);
        $cart = session()->get('carts');
        if (isset($cart[$id])) {
            $cart[$id]['quantity'] = $cart[$id]['quantity'] + $qantityProduct;
        } else {
            $cart[$id] = [
                'name' => $product->name,
                'price' => $product->price,
                'image_path' => $product->feature_image_path,
                'quantity' => $qantityProduct
            ];
        }
        session()->put('carts', $cart);
        return response()->json([
            'code' => 200,
            'message' => 'success',
        ], 200);
    }

    public function showCart()
    {
        $categories = Category::WHERE('parent_id', 0)
            ->get();
        $carts = session()->get('carts');
        return view('web.home.listCart', compact('categories', 'carts'));
    }

    public function updateCart(Request $request, $id)
    {
        if ($id && $request->quantity) {
            $carts = session()->get('carts');
            $carts[$id]['quantity'] = $request->quantity;
            session()->put('carts', $carts);
            $carts = session()->get('carts');
            $cartComponent = view('web.components.show_cart', compact('carts'))->render();
            return response()->json(['cart_component' => $cartComponent, 'code' => 200], 200);
        }
    }

    public function deleteCart($id)
    {
        if (!empty($id)) {
            $carts = session()->get('carts');
            unset($carts[$id]);
            session()->put('carts', $carts);
            $carts = session()->get('carts');
            $cartComponent = view('web.components.show_cart', compact('carts'))->render();
            return response()->json(['cart_component' => $cartComponent, 'code' => 200], 200);
        }
    }

    public function productDetail($id)
    {
        $categories = Category::WHERE('parent_id', 0)->get();
        $product = Product::find($id);
        $tags = $product->tags;
        $comments = Comment::where('product_id', $id)->where('comment_status',0)->paginate(20);
        $productRecommended = Product::inRandomOrder(20)->get();
        $ratting = Ratting::where('product_id', $id)->avg('ratting');
        return view('web.home.product_detail', compact('categories', 'product',
            'productRecommended', 'tags', 'comments', 'ratting'));
    }


    public function loginCheckout()
    {
        $categories = Category::WHERE('parent_id', 0)->get();
        $carts = session()->get('carts');
        return view('web.home.checkout', compact('categories', 'carts'));
    }

    public function saveCheckout(CheckOut $request)
    {
        $oders = Oder::create([
            'name' => $request->name,
            'user_id' => Auth::id(),
            'email' => $request->email,
            'address' => $request->address,
            'phone' => $request->phone,
            'note' => $request->note,
        ]);
        $dataOderDetail = [];
        $cart = session()->get('carts');
        foreach ($cart as $key => $value) {
            $dataOderDetail['oder_id'] = $oders->id;
            $dataOderDetail['product_id'] = $key;
            $dataOderDetail['name'] = $value['name'];
            $dataOderDetail['image_path'] = $value['image_path'];
            $dataOderDetail['price'] = $value['price'];
            $dataOderDetail['quantity'] = $value['quantity'];
            $dataOderDetail['total_money'] = ($value['price'] * $value['quantity']) + ($value['price'] * $value['quantity'] * 0.05);
            $dataOderDetail['pay_method'] = $request->pay_method;
            $dataOderDetail['status'] = '??ang ch??? x??? l??';
            \DB::table('oder_details')->insert($dataOderDetail);
        }

        if ($request->pay_method == 1) {

        }
        if ($request->pay_method == 2) {

        }
        if ($request->pay_method == 3) {
            session()->forget('carts');
            return redirect()->route('web.showCart')->with('tb', 'C???m ??n b???n ?????t h??ng, ch??ng t??i s??? li??n h??? l???i v???i b???n trong th???i gian s???m nh???t');
        }

    }

    public function getPayment()
    {
        $categories = Category::WHERE('parent_id', 0)->get();
        $carts = session()->get('carts');
        return view('web.home.payment', compact('categories', 'carts'));
    }


    public function tagsProduct(Request $request, $slug)
    {
        $data = $this->webService->getAll($request, $slug);
        list($sliders, $categories, $products, $productRecommended, $settings, $htmlSelect) = $data;

        return view('web.home.product_tag',
            compact(
                'sliders',
                'categories',
                'products',
                'productRecommended',
                'settings',
                'htmlSelect',
            ));
    }

    public function quickView($id)
    {
        $product = Product::find($id);
        $category = $product->category;
        $output['product_name'] = 'T??n s???n ph???m: ' . $product->name;
        $output['product_id'] = $id;
        $output['product_price'] = 'Gi??: ' . number_format($product->price) . 'VN??';
        $output['product_content'] = 'M?? t???: ' . $product->content;
        $output['product_image'] = '<p><img width="100%" src="' . $product->feature_image_path . '" alt=""></p>';
        $output['product_category'] = 'Danh m???c: ' . $category->name;
        $output['product_input_id'] = '<input hidden id="idProduct" value="' . $id . '" type="text" data-idProduct="' . $id . '">';
        return \response()->json($output);
    }


    public function insert_ratting(Request $request)
    {
        $ratting = Ratting::where('user_id', Auth::user()->id)->where('product_id', $request->product_id)->get();
        $result = $ratting->count();
        $dataRatting = [
            'user_id' => Auth::user()->id,
            'product_id' => $request->product_id,
            'ratting' => $request->index,
        ];
        if ($result) {
            return response()->json([
                'code' => 500,
                'message' => 'error'
            ], 500);
        } else {
            Ratting::create($dataRatting);
            return response()->json([
                'code' => 200,
                'message' => 'success',
            ], 200);
        }
    }
}
