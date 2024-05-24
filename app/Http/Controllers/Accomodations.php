<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Accomodation;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\AccomodationRequest;

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

    public function createAccomodation(AccomodationRequest $request){
        
        /*$data = new AccomodationRequest();
        $data->name = $request->name;
        $data->address = $request->address;
        $data->capacity = $request->capacity;
        $data->rooms = $request->rooms;
        $data->image_url = $request->image_url;
        $data->price = $request->price;
        $data->description = $request->description;*/

        /*$validator = Validator::make($request->all(), [
            "name" => "required",
            "address" => "required",
            "capacity" => "required",
            "rooms" => "required",
            "image_url" => "required",
            "price" => "required",
            "description" => "required",
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => false,
                'message' => 'Validator Error!',
                'data' => $validator->errors()
            ], 409);
        }*/

        $accomodationDatabase = Accomodation::where('name', $request->name)->first();
        if($accomodationDatabase){
            return response()->json([
                'status' => false,
                'message' => 'Accomodation already exists!',
                'data' => 'Not Data'
            ], 409);
        }
        
        try {
            
            $accomodation = Accomodation::create($request->all()); //Insert Into
        } catch (\Throwable $e) {
            return response()->json([
                'status' => false,
                'message' => 'Accomodation already exists!',
                'data' => $e->getMessage()
            ], 500);
        }
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
