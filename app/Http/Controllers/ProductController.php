<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Brand;
use App\Category; 
use App\Product;
use Validator;
class ProductController extends Controller
{
    public function all(){
    	$brands = Brand::all();
    	$categories = Category::all();
    	$products = Product::all();
    	return view('admin.catalog.product',[
    		'brands' => $brands,
    		'categories' => $categories,
    		'products' => $products
    	]);
    }
    public function create(){
        $brands = Brand::all();
        $categories = Category::all();
        return view('admin.catalog.product_create',[
            'categories' => $categories,
            'brands' => $brands
        ]);
    }
    public function createpost(Request $request){
    	$validator = Validator::make($request->all(),[
    		'name' => 'required|unique:product',
    		'price' => 'required|numeric',
    		'quantity' => 'required|numeric'
    	]);
    
    	if ($validator->fails()) {
		    //return redirect()->back()->withErrors($validator)->withInput();
		  return response()->json(['errors' => $validator->errors() ]);
        }
    	else{
    		$product = new Product();
    		$product->name = $request->name;
    		$product->price = $request->price;
    		$product->description = $request->description;
    		$product->quantity = (int) $request->quantity;
    		$product->id_brand = (int) $request->id_brand;
			$product->id_cat = (int) $request->id_cat;
			$product->url = $request->name;
    		$file = $request->image;
    		$product->image = uniqid().'_'.time().'_'.date('Ymd').'.' . $file->getClientOriginalName();
    		$product->is_feature = $request->is_feature;
            $product->status = $request->status;
    		$file->move('upload', $product->image);
    
    		$product->save();
    	//	return redirect()->route('product')->with('success', 'Add product successfully!');
            return response()->json(['success' => true]);
    	}
    }
    public function edit($id){
    	$product = Product::find($id);
		$brands = Brand::all();
        $categories = Category::all();
        return view('admin.catalog.product_update',[
            'categories' => $categories,
			'brands' => $brands,
			'product' => $product
        ]);
    }
    public function update(Request $request, $id){
		$product = Product::find($id);
		$product->name = $request->name;
		$product->price = $request->price;
		$product->description = $request->description;
		$product->quantity = (int) $request->quantity;
		$product->id_brand = (int) $request->id_brand;
		$product->id_cat = (int) $request->id_cat;
		$file = $request->image;
		// if( $file->getClientOriginalName()!= null){
		// 	$product->image = uniqid().'_'.time().'_'.date('Ymd').'.' . $file->getClientOriginalName();
		// }
		
		$product->is_feature = $request->is_feature;
		$product->status = $request->status;
		// $file->move('upload', $product->image);

		$product->save();
		return redirect()->route('product')->with('success', 'Update the product successfully!');
    }
    public function delete($id){
    	Product::find($id)->delete();
    	return redirect()->route('product')->with('success', 'Delete the product successfully!');
	}
}
