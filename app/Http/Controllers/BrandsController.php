<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Auth\Access\Response;
use DB;
use Auth;
use App\User;
use Illuminate\Support\Facades\Input;

class BrandsController extends Controller
{
    public function __construct(Response $response)
    {
        $this->response = $response;
    }

    public function getAllActive($status,$user_id) {
        $brands = Brand::where('status', $status)
            ->where('user_id', $user_id)
            ->orderBy('name', 'desc')
            ->take(10)
            ->get();
        return response($brands);
    }

    public function index(Request $request, $user_id)
    {
        $input = $request->all();
        if($request->get('search')){
            $brands = Brand::where("name", "LIKE", "%{$request->get('search')}%")
                ->where('user_id', $user_id)
                ->orWhere('created_at','LIKE',"%{$request->get('search')}%")
                ->paginate(5);
        }else{
            $brands = Brand::where('user_id', $user_id)->paginate(5);
        }
        return response($brands);

//        $brands = DB::table('brands')
//            ->select('brands.description as description',
//                'brands.name as brand_name',
//                'brands.created_at as created_at',
//                'brands.status as status',
//                'brands.id as brand_id')
//            ->join('users','users.id','=','brands.user_id')
//            ->where('users.id','=', $user_id )
//            ->where('brands.name','LIKE',"%{$request->get('search')}%" , 'AND', 'users.id','=', $user_id)
//            ->whereNull('deleted_at')
//            ->orderBy('brands.created_at', 'asc')
//            ->paginate(6);
//
//        return response($brands);
    }

    public function create()
    {

    }

    public function show($id)
    {
        $item = Brand::find($id);
        return response($item);
    }

    public function edit($id)
    {
        $item = Brand::find($id);
        return response($item);
    }


    public function update(Request $request, $id)
    {
        $user = new User();
        $user->fill(Input::get());
        $user->user_id = Auth::user()->id;

        $brand= Brand::findOrFail($id);
        $brand->name = $request['name'];
        $brand->description = $request['description'];
        $brand->user_id = "$user->user_id";

        $brand->save();

        return response($brand);

//        $input = $request->all();
//        Brand::where("id",$id)->update($input);
//        $item = Brand::find($id);
//        return response($item);
    }


    public function store(Request $request)
    {
        $user = new User();
        $user->fill(Input::get());
        $user->user_id = Auth::user()->id;

        $brand = new Brand();
        $brand->name = $request['name'];
        $brand->description = $request['description'];
        $brand->user_id = "$user->user_id";

        $brand->save();

        return response($brand);
    }

    public function destroy($id)
    {
        return Brand::where('id',$id)->delete();
    }

    public  function disable(Request $request, $id) {
        try{
            $brand= Brand::findOrFail($id);
            $brand->status = $request[0];
            $brand->updated_at = $request['$updated_at'];
            $brand->save();
            return response($brand);
        }
        catch(ModelNotFoundException $err){
            //Show error page
        }
    }

}
