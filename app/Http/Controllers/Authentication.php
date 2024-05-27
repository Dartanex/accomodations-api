<?php

namespace App\Http\Controllers;

use App\Models\Authentication as ModelsAuthentication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class Authentication extends Controller
{
    public function register(Request $request){

        $validator = Validator::make($request->all, [
            'fullname' => 'required|string|max:100',
            'username' => 'required|string|max:30',
            'email' => 'required|email',
            'password' => 'required|string|min:8|max:24',
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => false,
                'message' => 'Validator Error!',
                'data' => $validator->errors()
            ], 409);
        }

        $user = new ModelsAuthentication();
        $user->fullname = $request->fullname;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->role = 'mortal';
        $user->save();

        return response()->json([
            'message' => 'Register working',
        ]);
    }

    public function login(Request $request){

        return response()->json([
            'message' => 'Login working',
        ]);
    }
}
