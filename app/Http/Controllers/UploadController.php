<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductPhoto;
use Illuminate\Http\Request;
use Illuminate\Auth\Access\Response;
use App\Http\Requests\UploadRequest;
use Session;
use DB;

class UploadController extends Controller
{

    public function __construct(Response $response)
    {
        $this->response = $response;
    }

    public function showProduct(Request $request) {

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
                'products.type as product_type',
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
    }

    public function index(Request $request) {

//        $products = DB::table('products')
//            ->select('products.description as description',
//                'products.price as price',
//                'products.status as status',
//                'products.created_at as created_at',
//                'products.product_name as product_name',
//                'products.product_code as product_code',
//                'products.created_at as created_at',
//                'product_photos.name as photo_name',
//                'product_photos.product_id as product_id',
//                'products.type as product_type',
//                'categories.id as category_id',
//                'categories.name as category_name')
//            ->join('categories','categories.id', '=' ,'products.category_id')
//            ->join('product_photos','products.id', '=' ,'product_photos.product_id')
//            ->groupBy('products.product_name')
//            ->distinct('product_photos.product_id')
//            ->where("products.product_name","LIKE", "%{$request->get('search')}%")
//            ->orWhere('products.created_at','LIKE',"%{$request->get('search')}%")
//            ->paginate(6);
//
//        return response($products);
    }

//
//    public function show($id)
//    {
//        $productPhoto = ProductPhoto::with('product')->find($id);
//        return response($productPhoto);
//    }
//
//    public function getImages($proId) {
//        $productPhoto = ProductPhoto::where('product_id','=', $proId)->get();
//        return response($productPhoto);
//    }

}
