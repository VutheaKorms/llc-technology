<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductPhoto;
use App\Models\Photo;
use Illuminate\Http\Request;
use Illuminate\Auth\Access\Response;
use Session;
use DB;
use Auth;
use App\User;
use Illuminate\Support\Facades\Input;

class ProductsController extends Controller
{
    public function __construct(Response $response)
    {
        $this->response = $response;
    }

    public function index(Request $request, $user_id)
    {
        $input = $request->all();
        if($request->get('search')){
            $products = Product::with('categories','brands')->where('user_id',$user_id)->where("product_name", "LIKE", "%{$request->get('search')}%")
                ->orWhere('created_at','LIKE',"%{$request->get('search')}%")
                ->paginate(6);
        }else{
            $products = Product::with('categories','brands')->where('user_id', $user_id)->paginate(6);
        }
        return response($products);
    }

    public function show($id) {

        $products = DB::table('products')
            ->select('products.description as description',
            'products.price as price',
            'products.specification as specification',
            'products.status as status',
            'products.created_at as created_at',
            'products.product_name as product_name',
            'products.product_code as product_code',
            'products.product_color as product_color',
            'products.type as product_type',
            'brands.name as brand_name',
            'categories.name as category_name')
            ->join('categories','categories.id', '=' ,'products.category_id')
            ->join('brands','brands.id', '=' ,'products.brand_id')
            ->where('products.id', $id)
            ->get();

        return response($products);
    }

    public function showPhoto($id)
    {
        $product_photo = DB::table('product_photos')
            ->select('product_photos.product_id as product_id','product_photos.name as image', 'product_photos.id as id',
            'product_photos.deleted_at as deleted_at', 'product_photos.status as status',
            'product_photos.size as photo_size','product_photos.type as photo_type','products.product_name as product_name')
            ->join('products','products.id', '=' ,'product_photos.product_id')
            ->where('product_photos.product_id',$id)
            ->orderBy('product_photos.deleted_at')
            ->get();

        return response($product_photo);
    }

    public function editPhoto($id)
    {
        $item = ProductPhoto::find($id);
        return response($item);
    }

    public function edit($id)
    {
        $item = Product::find($id);
        return response($item);
    }


    public function update(Request $request, $id)
    {
        $user = new User();
        $user->fill(Input::get());
        $user->user_id = Auth::user()->id;

        $product= Product::findOrFail($id);
        $product->product_name = $request['product_name'];
        $product->product_code = $request['product_code'];
        $product->product_color = $request['product_color'];
        $product->price = $request['price'];
        $product->category_id = $request['category_id'];
        $product->type = $request['type'];
        $product->specification = $request['specification'];
        $product->brand_id = $request['brand_id'];
        $product->description = $request['description'];
        $product->user_id = "$user->user_id";

        $product->save();

        Session::put('product_id', $product->id);
        Session::put('category_id', $product->category_id);

        return response($product);
    }

    public function editUpload(Request $request)
    {
        $product_id = $request->session()->get('product_id');
        $category_id = $request->session()->get('category_id');

        $tempPath = $_FILES['file']['tmp_name'];
        $uploadPath = 'uploads/' . $_FILES['file']['name'];
        $size = $_FILES['file']['size'];
        $type = $_FILES['file']['type'];

        move_uploaded_file($tempPath, $uploadPath);

        $upload = new ProductPhoto();
        $upload->product_id = $product_id;
        $upload->category_id = $category_id;
        $upload->name = "$uploadPath";
        $upload->size = "$size";
        $upload->type = "$type";

        $upload->save();
    }

    public function store(Request $request)
    {
        $user = new User();
        $user->fill(Input::get());
        $user->user_id = Auth::user()->id;

        $product = new Product();
        $product->product_name = $request['product_name'];
        $product->product_code = $request['product_code'];
        $product->product_color = $request['product_color'];
        $product->price = $request['price'];
        $product->category_id = $request['category_id'];
        $product->type = $request['type'];
        $product->specification = $request['specification'];
        $product->brand_id = $request['brand_id'];
        $product->description = $request['description'];
        $product->user_id = "$user->user_id";

        $product->save();

        Session::put('product_id', $product->id);
        Session::put('category_id', $product->category_id);

        return response($product);

//        $input = $request->all();
//        $create = Product::create($input);
//
//        Session::put('product_id', $create->id);
//        Session::put('category_id', $create->category_id);
//
//        return response($create);
    }


    public function upload(Request $request)
    {
        $product_id = $request->session()->get('product_id');
        $category_id = $request->session()->get('category_id');

        $tempPath = $_FILES['file']['tmp_name'];
        $uploadPath = 'uploads/' . $_FILES['file']['name'];
        $size = $_FILES['file']['size'];
        $type = $_FILES['file']['type'];

        move_uploaded_file($tempPath, $uploadPath);

        $upload = new ProductPhoto();
        $upload->product_id = $product_id;
        $upload->category_id = $category_id;
        $upload->name = "$uploadPath";
        $upload->size = "$size";
        $upload->type = "$type";

        $upload->save();
    }

    public function destroy($id)
    {
        return Product::where('id',$id)->delete();
    }


    public  function destroyPhoto($id)
    {
        $product_photo = DB::delete('delete from product_photos where id = ?',[$id]);
        return response($product_photo);
    }

    public  function disable(Request $request, $id)
    {
        try {
            $products = Product::findOrFail($id);
            $products->status = $request[0];
            $products->updated_at = $request['$updated_at'];
            $products->save();
            return response($products);
        }
        catch(ModelNotFoundException $err){
                //Show error page
        }
    }

}
