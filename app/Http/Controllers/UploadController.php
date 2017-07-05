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

    public function show($id)
    {
        $productPhoto = ProductPhoto::with('product')->find($id);
        return response($productPhoto);
    }


}
