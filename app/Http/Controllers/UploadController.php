<?php

namespace App\Http\Controllers;

use App\Models\Cover;
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

    public function upload(Request $request)
    {
        $tempPath = $_FILES['file']['tmp_name'];
        $uploadPath = 'uploads/' . $_FILES['file']['name'];
        $size = $_FILES['file']['size'];
        $type = $_FILES['file']['type'];

        move_uploaded_file($tempPath, $uploadPath);

        $upload = new Cover();
        $upload->name = "$uploadPath";
        $upload->size = "$size";
        $upload->type = "$type";

        $upload->save();
    }

    public function index() {
        $cover = DB::table('covers')
            ->select('covers.name as name',
                'covers.id as id',
                'covers.size as size',
                'covers.type as type',
                'covers.created_at as created_at')
            ->get();

        return response($cover);
    }

    public  function destroyPhoto($id)
    {
        $product_photo = DB::delete('delete from covers where id = ?',[$id]);
        return response($product_photo);
    }

    public function editPhoto($id)
    {
        $item = Cover::find($id);
        return response($item);
    }

}
