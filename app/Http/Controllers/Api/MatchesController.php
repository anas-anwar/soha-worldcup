<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Matchs;
use Illuminate\Http\Request;

class MatchesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $matches=Matchs::with(['events','players','local_team','visitor_team'])->get();
        return response()->json($matches);  
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            "round_id"=>"required",
            "stadium_id"=>"required",
            "localteam_id"=>"required|different:visitorteam_id",
            "visitorteam_id"=>"required|different:localteam_id"
        ]);
        $match=Matchs::create($request->all());
        $match->refresh();
        return response()->json($match,201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $matche=Matchs::with(['events','players','local_team','visitor_team'])->findOrFail($id);
        return response()->json($matche);
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
        $match=Matchs::findOrFail($id);
        $request->validate([
            "round_id"=>"sometimes|required",
            "stadium_id"=>"sometimes|required",
            "localteam_id"=>"sometimes|required|different:visitorteam_id",
            "visitorteam_id"=>"sometimes|required|different:localteam_id"
        ]);

        $match=Matchs::findOrFail($id);
        $match->update($request->all());
        if($match->localteam_id==$match->visitorteam_id){
        return response()->json([
            "code"=>"422",
            "message"=>"Local team must be different from visitor id :) ",
            
        ]);}
        return response()->json([
            "message"=>"Match updated",
            "data"=>$match
        ]);
      
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $match=Matchs::findOrFail($id);
        $match->delete();
        return response()->json([
            "message"=>"Match Deleted",
            "data"=>$match
        ]);
          
    }
}
