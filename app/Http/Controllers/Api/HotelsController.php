<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Hotel;
use App\Models\Images;
use App\Models\Room;
use App\Models\Service;
use Illuminate\Http\Request;

class HotelsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $hotels = Hotel::with('images')->get();
        return response()->json([
            "status" => true,
            'message' => 'success',
            'data' => $hotels
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                "name" => 'required|string',
                "description" => 'required|string',
                "phone" => "required|numeric",
                "rate" => "required|min:0|max:5",
                "latitude" => "required",
                "longtude" => "required",
                "address" => 'required',
                "hotel_url" => "required"



            ]
        );
        $hotel = Hotel::create($request->all());
        $hotel->refresh();
        return response()->json([
            "status" => true,
            'message' => 'success',
            'data' => $hotel
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $hotel = Hotel::findOrFail($id);
        return response()->json($hotel, 201);
        return response()->json([
            "status" => true,
            'message' => 'success',
            'data' => $hotel
        ], 201);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate(
            [
                "name" => 'sometimes|required|string',
                "description" => 'sometimes|required|string',
                "phone" => "sometimes|required|numeric",
                "rate" => "sometimes|required|min:0|max:5'",
                "latitude" => "sometimes|required",
                "longtude" => "sometimes|required",
                "address" => 'sometimes|required',
                "hotel_url" => "sometimes|required"
            ]
        );
        $hotel = Hotel::findOrFail($id);
        $hotel->update($request->all());
        return response()->json(
            [
                "status" => true,
                'message' => 'Hotel updated ^_^',
                'data' => $hotel
            ]
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $hotel = Hotel::findOrFail($id);
        $hotel->delete();
        return response()->json(
            [
                "status" => true,
                'message' => 'Hotel deleted',
                'data' => $hotel
            ]
        );
    }


    ////////////////////////////////////////////////////////
    public function selectService(Request $request, $id)
    {
        $hotel = Hotel::with("services")->findOrFail($id);
        $services = Service::all();
        $types = array();

        foreach ($hotel->services as $serv) {
            array_push($types, $serv->type);
        }
        foreach ($services as $service) {
            //  return response($types);
            if ($request->type == $service->type && !in_array($request->type, $types)) {
                array_push($types, $request->type);
                $service_R = new Service(["type" => $service->type]);
                $hotel->services()->saveMany([$service_R]);
                return response([
                    "status" => true,
                    "message" => "Service added ^_^",
                    "data" => ["name" => $hotel->name, "type of services" => $types]
                ]);
            }
        }
        if (in_array($request->type, $types)) {
            return response([
                "status" => false,
                "message" => "This service already exist",
            ]);
        }
        return response([
            "status" => false,
            "message" => "This service doesn't exist",

        ]);
    }

    //////////////////////////////////////////////////////////////////////////////////////////////

    public function addImage(Request $request, $id)
    {
        $hotel = Hotel::with('images')->findOrFail($id);

        if (!$request->hasFile('fileName')) {
            return response()->json([
                "status" => false,
                'message' => 'upload_file_not_found'
            ], 400);
        }

        $allowedfileExtension = ['pdf', 'jpg', 'png'];
        $file = $request->file('fileName');



        $extension = $file->getClientOriginalExtension();

        $check = in_array($extension, $allowedfileExtension);

        if ($check) {


            $path = $file->store('storage/images');
            $name = $file->getClientOriginalName();

            //store image file into directory and db
            // $save = new Images();
            // $save->name = $name;
            // $save->image_url = $path;
            // $save->save();


            $hotel->images()->saveMany([
                new Images(["name" => $name, "image_url" => $path])
            ]);

            return response()->json([
                "status" => true,
                "message" => "Image uploaded ^-^",
                "data" => [
                    "name" => $hotel->name,
                    "images" =>
                    $hotel->images()->get()
                ]
            ]);
        } else {
            return response()->json([
                "status" => false,
                "message" => 'invalid_file_format'
            ],422);
        }
    }

    //////////////////////////////////////////////////////////////////////
    public function addRoom(Request $request,$id){
        $hotel=Hotel::with("rooms")->findOrFail($id);
       
 $request->validate([
     "type"=>["required",
     function ($attribute, $value, $fail) {
       $id="SELECT id FROM rooms WHERE type = $value ";
        if (!$id) {
            $fail('The '.$attribute.' not available');
        }
    } ,"string"],
    "url"=>"required|string",
    "price"=>["required",
    function ($attribute, $value, $fail) {
       
         if ($value<10 ||$value>1000) {
             $fail('The '.$attribute.' must be between 10- to 1000');
         }}]
 ]);
    
          //  return response($types);
           
                  
            $new_room=Room::create([
                "type"=>$request->type,
                "url"=>$request->url,
                "hotel_id"=>$id,
                "price"=>$request->price
            ]);
           return response([
               "status" => true,
               "message"=>"Service added ^_^",
               "data"=>["name"=>$hotel->name,"Room"=>$new_room]
           ]);
         
        
      }


}
