<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Accomodation;

class Accomodations extends Controller
{
    public function test(){
        return response()->json([
                'status' => true,
                'message' => 'Api is working perfectly'
            ]);
    }

    public function accomodations(){
        //METODO 1
        $accomodations = Accomodation::where('disabled', false)->get(); // SELECT * FROM [nombre_tabla]

        //METODO 2

        return response()->json([
            'status' => true,
            'message' => 'Get all accomodations',
            'data' => $accomodations
        ]);
    }

    public function accomodation($id){
        
        $accomodation = Accomodation::find($id);
        if($accomodation->disabled){
            return response()->json([
                'status' => false,
                'message' => 'Get accomodation by id ' . $id . ' Not Found',
                'data' => 'not data'
            ], 404);  
        }

        if(!$accomodation){
            return response()->json([
                'status' => false,
                'message' => 'Get accomodation by id ' . $id . ' Not Found',
                'data' => $accomodation
            ], 404);  
        }
        return response()->json([
            'message' => 'Get accomodation by id ' . $id,
            'data' => $accomodation
        ], 200);
    }

    public function createAccomodation(Request $request){
        $accomodationDatabase = Accomodation::where('name', $request->name)->first();
        if($accomodationDatabase){
            return response()->json([
                'status' => false,
                'message' => 'Accomodation already exists!',
                'data' => 'Not Data'
            ], 409); 
        }
        
        $accomodation = Accomodation::create($request->all()); //Insert Into
        return response()->json([
            'status' => true,
            'message' => 'New accomodation created!',
            'data' => $accomodation
        ], 201);
    }

    public function updateAccomodation(Request $request, $id){

        $accomodation = Accomodation::find($id);
        if (!$accomodation){
            return response()->json([
            'status' => false,
            'message' => 'Accomodation not found!',
            'data' => $accomodation
        ], 404);
        }
        $accomodation->update($request->all()); //Update Accomodation
        return response()->json([
            'status' => true,
            'message' => 'Updated accomodation',
            'data' => $accomodation
        ]);
    }

    public function destroyAccomodation($id){

        $accomodation = Accomodation::find($id);
        if (!$accomodation){
            return response()->json([
            'status' => false,
            'message' => 'Accomodation not found!',
            'data' => $accomodation
        ], 404);
        }

        $accomodation->update(['disabled' => true]);

        return response()->json([
            'message' => 'Deleted accomodation with id ' . $id,
            'data' => $accomodation
        ], 200);
    }

    public function patchAccomodation(Request $request, $id){
        $accomodation = Accomodation::find($id);
        if (!$accomodation){
            return response()->json([
            'status' => false,
            'message' => 'Accomodation not found!',
            'data' => $accomodation
        ], 404);
        }
        $accomodation->update($request->all()); //Update Accomodation
        return response()->json([
            'status' => true,
            'message' => 'Updated accomodation',
            'data' => $accomodation
        ]);
    }
}
