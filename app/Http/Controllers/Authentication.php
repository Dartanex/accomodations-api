<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Authentication extends Controller
{
    public function register(Request $request){

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
