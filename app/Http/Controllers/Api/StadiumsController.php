<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Images;
use App\Models\Stadium;
use Illuminate\Http\Request;

class StadiumsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stadiums=Stadium::all();
     return response()->json($stadiums);
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
                "name"=>'required|string',
                "description"=>'required|string',
                "phone"=>"required|numeric",
             
                "latitude"=>"required",
                "longtude"=>"required",
                "address"=>'required',
                "capacity"=>"required",
               



            ]
            );
            $stadium=Stadium::create( $request->all());
            $stadium->refresh();
            return response()->json($stadium,201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $stadium=Stadium::findOrFail($id);
        return response()->json($stadium);
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
                "name"=>'sometimes|required|string',
                "description"=>'sometimes|required|string',
                "phone"=>"sometimes|required|numeric",
                "capacity"=>"sometimes|required",
                "lattude"=>"sometimes|required",
                "longtude"=>"sometimes|required",
                "address"=>'sometimes|required',
                


            ]
            );
            $stadium=Stadium::findOrFail($id);
            $stadium->update( $request->all());
            return response()->json(
                ['message'=>'Stadium updated',
                   'data'=> $stadium]);
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $stadium=Stadium::findOrFail($id);
        $stadium->delete();
        return response()->json(
            ['message'=>'Stadium deleted',
               'data'=> $stadium]);
    }





    public function addImage(Request $request, $id){
        $stadium=Stadium::with('images')->findOrFail($id);
        
    if(!$request->hasFile('fileName')) {
        return response()->json(['upload_file_not_found'], 400);
    }
 
    $allowedfileExtension=['pdf','jpg','png'];
    $file = $request->file('fileName'); 
    
    
    
     
        $extension = $file->getClientOriginalExtension();
 
        $check = in_array($extension,$allowedfileExtension);
        
        if($check) {
           
 
                $path = $file->store('public/images');
                $name = $file->getClientOriginalName();
      
                //store image file into directory and db
                $save = new Images();
                $save->name = $name;
                $save->image_url = $path;
                $save->save();
                $stadium->images()->saveMany([
                   new Images(["name"=>$name,"image_url"=>$path])
               ]);
                return response()->json([
                    "message"=>"Image uploaded",
                    "data"=>$stadium
                ]);
           
        } else {
            return response()->json([
                "code"=>"422",
               "message"=> 'invalid_file_format']);
        }
 
 
 
    
    
}

    }
