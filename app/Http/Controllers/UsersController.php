<?php

namespace App\Http\Controllers;

use App\User;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Auth\Access\Response;

class UsersController extends Controller
{
    public function __construct(Response $response)
    {
        $this->response = $response;
    }

    public function index()
    {
//        $input = $request->all();
//        if($request->get('search')){
//            $users = User::where("name", "LIKE", "%{$request->get('search')}%")
//                ->orWhere('created_at','LIKE',"%{$request->get('search')}%")
//                ->paginate(5);
//        }else{
//            $users = User::paginate(5);
//        }
        $users = User::get();
        return response($users);
    }


    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);

        return response($user);
    }

    public function updateUser(Request $request, $id)
    {
        $user = Auth::user()->find($id);

        $user->name = Request::input('name');
        $user->email = Request::input('email');

        if ($request->has('password')) $user->password = bcrypt($request->input('password'));

        $user->save();

       return response($user);
    }


    public function show($id = null)
    {
        $userId = $id ?: auth()->user()->id;

        $user = User::findOrFail($userId);

        return response($user);

        // return the the view with the user
    }


//    public function show($id)
//    {
//        $item = User::find($id);
//        return response($item);
//    }

    public function edit($id)
    {
        $item = User::find($id);
        return response($item);
    }

    public  function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->name = $request['name'];
        $user->email = $request['email'];
        if ($request->has('password'))  {
            $user->password = bcrypt($request->input('password'));
        }
        $user->save();
        return response($user);
    }

    public function store(Request $request)
    {
        $input = $request->all();
        $create = User::create($input);
        return response($create);
    }

    public function destroy($id)
    {
        return User::where('id',$id)->delete();
    }

    public  function disable(Request $request, $id)
    {
        try {
            $users = User::findOrFail($id);
            $users->status = $request[0];
            $users->updated_at = $request['updated_at'];
            $users->save();
            return response($users);
        }
        catch(ModelNotFoundException $err){
            //Show error page
        }
    }

    public  function enable(Request $request, $id)
    {
        try {
            $users = User::findOrFail($id);
            $users->status = 1;
            $users->updated_at = $request['updated_at'];
            $users->save();
            return response($users);
        }
        catch(ModelNotFoundException $err){
            //Show error page
        }
    }
}
