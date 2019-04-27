<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Category;
use App\Brand;
use App\User;
use App\Bill;
use App\DetailBill;
use Cart;
use Validator;

class IndexController extends Controller
{
    public function index(){
    	$pr_features = Product::where('is_feature',1)->get();
    	$pr_news = Product::orderBy('id','desc')->get();
        return view('frontend.pages.home',[
    		'pr_features' => $pr_features,
            'pr_news' => $pr_news
    	]);
    }
    public function pages($route){
    	$category = Category::where('slug' , $route)->first();
    	$products = Product::where('id_cat', $category->id)->get();
    	return view('frontend.pages.product',[
    		'products' => $products
    	]);
        
    }
    public function getDetailProduct($url){
        $product = Product::where('url' , $url)->first();
        $brand = Brand::find($product['id_brand'])->first();
        return view('frontend.pages.product-detail',[
            'product' => $product,
            'brand' => $brand
        ]);
    }
    public function cart(){
        $products = Cart::content();
        $total = 0;
        foreach ($products as $key => $value) {
            $total  += $value->qty * $value->price;
        }
        return view('frontend.pages.cart',[
            'products' => $products,
            'total' => $total
        ]);
    }
    public function addToCart($id){
        $product = Product::find($id);
        Cart::add([
            'id' => $product['id'],
            'name' => $product['name'],
            'image' => $product['image'],
            'price' => $product['price'],
            'qty' => 1,
            'options' => ['image' => $product['image']]
        ]);
        $count = Cart::count();
        $content = '';
        $total = 0;
        foreach (Cart::content() as $key => $value) {
            $img = "http://" . $_SERVER['HTTP_HOST'] . '/upload/' .$value->options->image;
            $content .= '<li class="header-cart-item">'.
                '<div class="header-cart-item-img">'.
                '<img src="'. $img. '" >' . '</div><div class="header-cart-item-txt">'.
                '<a href="#" class="header-cart-item-name">'.
                                            $value->name
                                        .'</a>'.
'<span class="header-cart-item-info">'. $value->qty .'x' . $value->price .'đ' .
                                        '</div></li>';
                $total  += $value->qty * $value->price;                        
        }
       
        echo json_encode(['success' => true,'content' => $content ,
            'total' => $total
    ]);
    }
    public function updateCart($id){
        $qty = $_GET['qty'];
        Cart::update($id, $qty);
        $content = '';
        $total = 0;
        foreach (Cart::content() as $key => $value) {
            $img = "http://" . $_SERVER['HTTP_HOST'] . '/upload/' .$value->options->image;
            $content .= '<li class="header-cart-item">'.
                '<div class="header-cart-item-img">'.
                '<img src="'. $img. '" >' . '</div><div class="header-cart-item-txt">'.
                '<a href="#" class="header-cart-item-name">'.
                                            $value->name
                                        .'</a>'.
'<span class="header-cart-item-info">'. $value->qty .'x' . $value->price .'đ' .
                                        '</div></li>';
                $total  += $value->qty * $value->price;                        
        }
        $count = Cart::count();
        echo json_encode([
            'success' => true,
            'total' => $total,
            'content' => $content,
            'count' => $count
        ]);
    }
    public function deleteCart($id){
        Cart::remove($id);
        echo json_encode(['success' => true]);
    }
    public function destroyCart(){
        Cart::destroy();
        echo json_encode(['success' => true]);    
    }
    public function checkout(){
        return view('frontend.pages.checkout');
    }
    public function postCheckOut(Request $request){
        // $user = new User();
        $validator = Validator::make($request->all(),[
            'email' => 'required',
            'fullname' => 'required',
            'phone' => 'required',
            'address' => 'required'
        ]);
        if ($validator->fails()) {
            $errors = $validator->errors();
            return response()->json(['errors'=> $errors]);
        }else{
            if($request->method == 1){
                $user = new User();
                $user->fullname = $request->fullname;
                $user->email = $request->email;
                $user->phone = $request->phone;
                $user->address = $request->address;
                $user->save();
                $bill = new Bill();
                $bill->id_user = $user->id;
                $bill->total = $request->total;
                $bill->save();
                $carts = Cart::content();
                
                foreach ($carts as $key => $value) {
                    $detail = new DetailBill();    
                    $detail->id_bill = $bill->id;
                    $detail->id_p = $value->id;
                    $detail->qty= $value->qty;
                    $detail->save();
                }
                Cart::destroy();
                echo json_encode(['success' => true]); 
            }else{
                return redirect()->route('paypal');
            }
            
        }
    }
}
