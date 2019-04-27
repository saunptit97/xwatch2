<?php

namespace App\Http\Controllers;

use App\Repositories\Repository;
use Illuminate\Http\Request;
use App\Category;
use Validator;

class CategoryController extends Controller
{
    /**
     * @var Repository|string
     */
    protected $category = 'category';

    /**
     * CategoryController constructor.
     * @param Category $category
     */
    public function __construct(Category $category)
    {
        $this->category = new Repository($category);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function all(){
        $categories = $this->category->all();
        return view('admin.catalog.category', ['categories' => $categories]);
    }

    public function create(){
        return view('admin.catalog.category_create');
    }
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function createpost(Request $request){
        $validator = Validator::make($request->all(), [
            'name'    => 'required|unique:category'
        ]);
        $data[] = null;
        if ($validator->fails()) {
            $errors = $validator->errors();
            return response()->json(['errors'=> $errors]);
        }else{
            $category = new Category();
            $category->name = $request->name;
            if($request->slug){
                $category->slug = $request->slug;
            }
            else{
                $category->slug = $this->to_slug($category->name);
            }
            $category->description = $request->description;
            $category->save();
            //echo $category->description;
            return response()->json(['success' => true]);
        }

    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id){
        $validator = Validator::make($request->all(), [
            'name'    => 'required|unique:category,name,' .$id
        ]);
        $data[] = null;
        if ($validator->fails()) {
            $errors = $validator->errors();
            return response()->json(['errors'=> $errors]);
        }else{
            $category = Category::find($id);
            $category->name = $request->name;
            if($request->slug){
                $category->slug = $request->slug;
            }
            else{
                $category->slug = $this->to_slug($category->name);
            }
            $category->description = $request->description;
            //echo $request->description;
            $category->save();
            return response()->json(['success' => true]);
        }
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function edit($id){
        $category = Category::find($id);
        return view('admin.catalog.category_create', ['category' => $category]);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($id){

        $this->category->delete($id);
        return redirect()->route('category');
    }
    /**
     * @param $str
     * @return null|string|string[]
     */
    public function to_slug($str) {
        $str = trim(mb_strtolower($str));
        $str = preg_replace('/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/', 'a', $str);
        $str = preg_replace('/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/', 'e', $str);
        $str = preg_replace('/(ì|í|ị|ỉ|ĩ)/', 'i', $str);
        $str = preg_replace('/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/', 'o', $str);
        $str = preg_replace('/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/', 'u', $str);
        $str = preg_replace('/(ỳ|ý|ỵ|ỷ|ỹ)/', 'y', $str);
        $str = preg_replace('/(đ)/', 'd', $str);
        $str = preg_replace('/[^a-z0-9-\s]/', '', $str);
        $str = preg_replace('/([\s]+)/', '-', $str);
        return $str;
    }
}
