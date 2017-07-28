<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Auth\Access\Response;
use DB;

class ItemController extends Controller
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
                'product_photos.deleted_at as deleted_at',
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
    public function store(Request $request)
    {

    }
    public function edit($id)
    {

    }
    public function update(Request $request,$id)
    {

    }
    public function destroy($id)
    {

    }


    public function detail($id) {

        $product = DB::table('products')
            ->select('products.description as description',
                'products.price as price',
                'products.id as product_id',
                'products.specification as specification',
                'products.status as status',
                'products.created_at as created_at',
                'products.product_name as product_name',
                'products.product_code as product_code',
                'products.product_color as product_color',
                'products.type as product_type',
                'categories.name as category_name')
            ->join('categories','categories.id', '=' ,'products.category_id')
            ->where('products.id','=', $id)
            ->get();

        $product_photo = DB::table('product_photos')
            ->select('product_photos.product_id as product_id','product_photos.name as image')
            ->where('product_photos.product_id',$id)
            ->get();

        return view('product_details', ['product' => $product, 'product_photo' => $product_photo]);

        //return view('product_details')->with('product', $product);
    }

}
