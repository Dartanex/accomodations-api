<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Accomodations extends Controller
{
    public function test(){
        return response()->json([
                'status' => true,
                'message' => 'Api is working perfectly'
            ]);
    }

    public function accomodations(){

        return response()->json([
            'message' => 'Get all accomodations'
        ]);
    }

    public function accomodation($id){
        return response()->json([
            'message' => 'Get accomodation by id ' . $id
        ]);
    }

    public function createAccomodation(){

        return response()->json([
            'message' => 'New accomodation created!'
        ]);
    }

    public function updateAccomodation($id){

        return response()->json([
            'message' => 'Update accomodation with id ' . $id
        ]);
    }

    public function destroyAccomodation($id){

        return response()->json([
            'message' => 'Deleted accomodation with id ' . $id
        ]);
    }
}
