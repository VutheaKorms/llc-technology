<?php

namespace App\Http\Controllers;
use App\Models\Address;
use App\Models\contact;
use Illuminate\Http\Request;
use Illuminate\Auth\Access\Response;


class ContactsController extends Controller
{
    public function __construct(Response $response)
    {
        $this->response = $response;
    }

    public function index(Request $request)
    {
        $input = $request->all();
        if ($request->get('search')) {
            $address = Address::where("country", "LIKE", "%{$request->get('search')}%")
                ->orWhere('created_at', 'LIKE', "%{$request->get('search')}%")
                ->paginate(5);
        } else {
            $address = Address::paginate(5);
        }
        return response($address);
    }

    public function getContact(Request $request ,$user_id)
    {
        $input = $request->all();
        if($request->get('search')){
            $contact = contact::with('address')->where("contact_name", "LIKE", "%{$request->get('search')}%")
                ->where('user_id',$user_id)
                ->orWhere('created_at','LIKE',"%{$request->get('search')}%")
                ->paginate(5);
        }else{
            $contact = contact::with('address')->where('user_id',$user_id)->paginate(5);
        }
        return response($contact);
    }

    public function getAllActive($status,$user_id) {
        $contact = contact::with('address')->where('status', $status)
            ->where('user_id', $user_id)
            ->orderBy('contact_name', 'asc')
            ->get();
        return response($contact);
    }



}
