<?php

namespace App\Http\Controllers\Api\Mobile;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Matchs;
use App\Models\Player;
use App\Models\TypeOfEvent;
use Carbon\Carbon;
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

$upcoming_time=Carbon::now()->format('h:i:s');
$date=Carbon::now()->yesterday();
        $mytime = Carbon::now()->format('H:i:s');
        $upcoming_matches= Matchs::where("start","<=",$upcoming_time)
        ->where("start",">=",$mytime)
        ->orderBy('created_at',"DESC")
        ->with(['events','players','local_team','visitor_team'])
        ->get();
        $live_matches= Matchs::where("start","<=",$mytime)
        ->where("date",">=",$mytime)
        ->orderBy('created_at',"DESC")
        ->with(['events','players','local_team','visitor_team'])
        ->get();
        //$plyers=[];
        //$events=$live_matches->events;
        $goal_id=TypeOfEvent::where("name",'LIKE','%yello%')->value('id');
     $goal_event=Event::where("typeofevent_id",$goal_id)->get();
       
     
        return response()->json(
            
            ["upcoming matches"=>[
            "teams name"=>["local team name"],
            ["visitor team name"=>$upcoming_matches]],
            ["match time"=>["strat time"=>$upcoming_matches],
            [" end time"=>$upcoming_matches]],
           ["match date"=>$upcoming_matches]
        ],
    ["live matches"=>[
        "teams name"=>["local team name"=>$live_matches],
            ["visitor team name"=>$live_matches], 
            ["players scored goal"]=>$goal_event->player->name
    ]

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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
