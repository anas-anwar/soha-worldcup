<?php

namespace App\Http\Controllers\Api;

use App\Models\Resturent;
use App\Http\Controllers\Controller;
use App\Models\Images;
use App\Models\Service;
use Illuminate\Http\Request;

class ResturentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $resturents = Resturent::all();

        return response()->json($resturents);
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
                "phone" => "required|numeric",
                "rate"=>["required",
                function ($attribute, $value, $fail) {
                   
                     if ($value<0 ||$value>5) {
                         $fail('The '.$attribute.' must be between 10- to 1000');
                     }}],
                "latitude" => "required",
                "longtude" => "required",
                "address" => 'required',
                "menu_url" => "nullable",
                "hour_close" => "required|date_format:H:i|after:hour_open",
                "hour_open" => "required|date_format:H:i",



            ]
        );
        $resturent = Resturent::create($request->all());
        $resturent->refresh();
        return response()->json($resturent, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $resturent = Resturent::findOrFail($id);


        return response()->json($resturent, 201);
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
                "phone" => "sometimes|required|numeric",
                "rate"=>["sometime","required",
                function ($attribute, $value, $fail) {
                   
                     if ($value<0 ||$value>5) {
                         $fail('The '.$attribute.' must be between 10- to 1000');
                     }}],
                "latitude" => "sometimes|required",
                "longtude" => "sometimes|required",
                "address" => 'sometimes|required',
                "menu_url" => "sometimes|required",
                "hour_close" => "sometimes|required|date_format:H:i|after:hour_open",
                "hour_open" => "sometimes|required|date_format:H:i",


            ]
        );
        $resturent = Resturent::findOrFail($id);
        $resturent->update($request->all());
        return response()->json(
            [
                'message' => 'Resturent updated',
                'data' => $resturent
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
        $resturent = Resturent::findOrFail($id);
        $resturent->delete();
        return response()->json(
            [
                'message' => 'Resturent deleted',
                'data' => $resturent
            ]
        );
    }


    /////////////////////////////////////////////////////////////////////////////////////////////////////////

    public function selectService(Request $request, $id)
    {
        $resturent = Resturent::with("services")->findOrFail($id);
        $services = Service::all();
        $types = array();

        foreach ($resturent->services as $serv) {
            array_push($types, $serv->type);
        }



        foreach ($services as $service) {
            //  return response($types);
            if ($request->type == $service->type && !in_array($request->type, $types)) {
                array_push($types, $request->type);
                $service_R = new Service(["type" => $service->type]);
                $resturent->services()->saveMany([$service_R]);
                return response([
                    "message" => "Service added ^_^",
                    "data" => ["name" => $resturent->name, "type of services" => $types]
                ]);
            }
        }
        if (in_array($request->type, $types)) {
            return response([
                "message" => "This service already exist",

            ]);
        }
        return response([
            "message" => "This service doesn't exist",

        ]);
    }

    ////////////////////////////////////////////////////////////////////////////////////////////////

    public function addImage(Request $request, $id)
    {
        $resturent = Resturent::with('images')->findOrFail($id);

        if (!$request->hasFile('fileName')) {
            return response()->json(['upload_file_not_found'], 400);
        }

        $allowedfileExtension = ['pdf', 'jpg', 'png'];
        $file = $request->file('fileName');




        $extension = $file->getClientOriginalExtension();

        $check = in_array($extension, $allowedfileExtension);

        if ($check) {


            $path = $file->store('public/images');
            $name = $file->getClientOriginalName();

            //store image file into directory and db
            $save = new Images();
            $save->name = $name;
            $save->image_url = $path;
            $save->save();
            $resturent->images()->saveMany([
                new Images(["name" => $name, "image_url" => $path])
            ]);
            return response()->json([
                "message" => "Image uploaded ^-^",
                "data" => [
                    "name" => $resturent->name,
                    "images" =>
                    $resturent->images()->get()


                ]
            ]);
        } else {
            return response()->json([
                "code" => "422",
                "message" => 'invalid_file_format'
            ]);
        }
    }
}
