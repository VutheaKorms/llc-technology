<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductPhoto;
use Illuminate\Http\Request;
use Illuminate\Auth\Access\Response;
use App\Http\Requests\UploadRequest;

class UploadController extends Controller
{

    public function __construct(Response $response)
    {
        $this->response = $response;
    }

    public function index(Request $request) {
        $input = $request->all();
        if($request->get('search')){
            $product_photos = ProductPhoto::with('products')->where("product_name", "LIKE", "%{$request->get('search')}%")
                ->orWhere('created_at','LIKE',"%{$request->get('search')}%")
                ->paginate(6);
        }else{
            //$product_photos = ProductPhoto::paginate(5);
            $product_photos = ProductPhoto::with('products','categories')->paginate(6);
        }
        return response($product_photos);
    }


    public function show($id)
    {
        $productPhoto = ProductPhoto::with('product')->find($id);
        return response($productPhoto);
    }

    public function getImages($proId) {
        $productPhoto = ProductPhoto::where('product_id','=', $proId)->get();
        return response($productPhoto);
    }

}
