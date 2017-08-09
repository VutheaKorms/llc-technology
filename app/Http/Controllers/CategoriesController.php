<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Auth\Access\Response;
use DB;
use Session;
use Auth;
use App\User;
use Illuminate\Support\Facades\Input;

class CategoriesController extends Controller
{
    public function __construct(Response $response)
    {
        $this->response = $response;
    }

    public function getAllActive($status,$user_id) {
        $categories = Category::where('status', $status)
            ->where('user_id', $user_id)
            ->orderBy('name', 'asc')
            ->get();
        return response($categories);
    }

    public function getCateByBrand($status,$brand_id) {
        $cate = Category::where('brand_id', $brand_id)
            ->where('status', $status)
            ->orderBy('name', 'asc')
            ->get();
        return response($cate);
    }

    public function getProductByCate($cateId) {
        $pro = Product::where('category_id', $cateId)
            ->orderBy('product_name', 'asc')
            ->get();
        return response($pro);
    }

    public function index(Request $request, $user_id)
    {
        $input = $request->all();
        if($request->get('search')){
            $categories = Category::with('brands')->where("name", "LIKE", "%{$request->get('search')}%")
                ->where('user_id',$user_id)
                ->orWhere('created_at','LIKE',"%{$request->get('search')}%")
                ->paginate(5);
        }else{
            $categories = Category::with('brands')->where('user_id',$user_id)->paginate(5);
        }
        return response($categories);
    }

    public function create()
    {

    }

    public function show($id)
    {
        $categories = Category::with('brands')->find($id);
        return response($categories);
    }

    public function edit($id)
    {
        $item = Category::find($id);
        return response($item);
    }


    public function update(Request $request, $id)
    {
        $user = new User();
        $user->fill(Input::get());
        $user->user_id = Auth::user()->id;

        $cate= Category::findOrFail($id);
        $cate->name = $request['name'];
        $cate->description = $request['description'];
        $cate->brand_id = $request['brand_id'];
        $cate->user_id = "$user->user_id";

        $cate->save();

        return response($cate);

    }


    public function store(Request $request)
    {
        $user = new User();
        $user->fill(Input::get());
        $user->user_id = Auth::user()->id;

        $cate = new Category();
        $cate->name = $request['name'];
        $cate->description = $request['description'];
        $cate->brand_id = $request['brand_id'];
        $cate->user_id = "$user->user_id";

        $cate->save();

        return response($cate);
    }

    public function destroy($id)
    {
        $count = Product::where(['category_id' => $id])->count();
        if ($count >=1) {
            return;
        }
        return Category::where('id',$id)->delete();
    }

    public  function disable(Request $request, $id) {
        $count = Product::where(['category_id' => $id])->count();
        if ($count >=1) {
            return;
        }else {
            try{
                $category= Category::findOrFail($id);
                $category->status = $request[0];
                $category->updated_at = $request['$updated_at'];
                $category->save();
                return response($category);
            }
            catch(ModelNotFoundException $err){
                //Show error page
            }
        }

    }


}
