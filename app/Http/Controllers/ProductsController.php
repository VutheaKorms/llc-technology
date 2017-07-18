<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductPhoto;
use App\Models\Photo;
use Illuminate\Http\Request;
use Illuminate\Auth\Access\Response;
use Session;
use DB;

class ProductsController extends Controller
{
    public function __construct(Response $response)
    {
        $this->response = $response;
    }


    public function index(Request $request)
    {
        $products = DB::table('products')
            ->select('products.description as description',
                'products.price as price',
                'products.status as status',
                'products.created_at as created_at',
                'products.product_name as product_name',
                'products.product_code as product_code',
                'products.created_at as created_at',
                'product_photos.name as photo_name',
                'product_photos.product_id as product_id',
                'categories.id as category_id',
                'categories.name as category_name')
            ->join('categories','categories.id', '=' ,'products.category_id')
            ->join('product_photos','products.id', '=' ,'product_photos.product_id')
            ->groupBy('products.product_name')
            ->distinct('product_photos.product_id')
            ->where("products.product_name","LIKE", "%{$request->get('search')}%")
            ->orWhere('products.created_at','LIKE',"%{$request->get('search')}%")
            ->paginate(6);

        return response($products);


//        $input = $request->all();
//        if($request->get('search')){
//            $products = Product::with('categories')->where("product_name", "LIKE", "%{$request->get('search')}%")
//                ->orWhere('created_at','LIKE',"%{$request->get('search')}%")
//                ->paginate(6);
//        }else{
//            $products = Product::with('categories')->paginate(6);
//        }
//        return response($products);

//        $input = $request->all();
//        if($request->get('search')){
//            $product_photos = ProductPhoto::with('products')->where("product_name", "LIKE", "%{$request->get('search')}%")
//                ->orWhere('created_at','LIKE',"%{$request->get('search')}%")
//                ->paginate(6);
//        }else{
//            $product_photos = ProductPhoto::with('products','categories')->paginate(6);
//        }
//        return response($product_photos);
    }

    public function show($id) {

        $products = DB::table('products')
            ->select('products.description as description',
            'products.price as price',
            'products.status as status',
            'products.created_at as created_at',
            'products.product_name as product_name',
            'products.product_code as product_code',
            'categories.name as category_name')
            ->join('categories','categories.id', '=' ,'products.category_id')
            ->where('products.id', $id)
            ->get();

        return response($products);
    }

    public function showPhoto($id)
    {
        $product_photo = DB::table('product_photos')
//            ->leftJoin('products','products.id','=','product_photos.product_id')
            ->select('product_photos.product_id as product_id','product_photos.name as image')
            ->where('product_photos.product_id',$id)
            ->get();

        return response($product_photo);
    }

    public function edit($id)
    {
        $item = Product::find($id);
        return response($item);
    }


    public function update(Request $request, $id)
    {
        $input = $request->all();
        Product::where("id",$id)->update($input);
        $item = Product::find($id);
        return response($item);
    }

    public function store(Request $request)
    {
        $input = $request->all();
        $create = Product::create($input);

        Session::put('product_id', $create->id);
        Session::put('category_id', $create->category_id);

        return response($create);
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

    public function loadAllProductByCate($status,$cateId){
        $products = DB::table('products')
            ->select('products.id as product_id',
                'products.product_name as product_name',
                'products.product_code as product_code',
                'products.status as product_status',
                'categories.status as status',
                'categories.id as category_id',
                'categories.name as category_name')
            ->join('categories','products.category_id', '=', 'categories.id')
            ->where('products.status', $status, 'AND')
            ->where('products.category_id', $cateId)
            ->paginate(5);

        return response($products);
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
