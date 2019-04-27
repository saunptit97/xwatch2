<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Brand;
use Validator;
class BrandController extends Controller
{
    public function all(){
    	$brands = Brand::all();
    	return view('admin.catalog.brand', ['brands' => $brands]);
    }
    public function create(){
        return view('admin.catalog.brand_create');
    }
    public function createpost(Request $request){
        $validator = Validator::make($request->all(),[
            'name' => 'required',
        ]);
        if ($validator->fails()) {
            $errors = $validator->errors();
            return response()->json(['errors'=> $errors]);
        }else{
            $brand = new Brand();
            $brand->name = $request->name;
            $brand->description = $request->description;
            $file = $request->image;
            $brand->image = $file->getClientOriginalName();
           
            $brand->save();
            $file->move('upload', $file->getClientOriginalName());
            return response()->json(['success' => true]);
           // return redirect()->route('brand');
        }
    }
    public function delete($id){
        Brand::find($id)->delete();
        return response()->json(['success' => true]);
    }
    public function edit($id){
        $brand = Brand::find($id);
        return view('admin.catalog.brand_create', ['brand' =>$brand]);
    }
    public function update(Request $request, $id){
        $validator = Validator::make($request->all(),[
            'name' => 'required',
        ]);
        if ($validator->fails()) {
            $errors = $validator->errors();
           // return response()->json(['errors'=> $errors]);
        }else{
            $brand = Brand::find($id);
            $brand->name = $request->name;
            $brand->description = $request->description;
            if($request->image != ''){
                $file = $request->image;
                $brand->image = $file->getClientOriginalName(); 
                $file->move('upload', $file->getClientOriginalName());
            }
            $brand->save();
            
           // return response()->json(['success' => true]);
            return redirect()->route('brand');
        }
    }
}
