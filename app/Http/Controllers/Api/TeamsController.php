<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TeamsController extends Controller
{
    public function index()
    {
        $teams = Team::with(['players','stadium','group','events','account_odds','matchs'])->get();
        return response()->json($teams);
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
                "stadium_id" => 'required',

                'fileName' => 'image',
                "shirt_color" => "required",
                "group_id" => "required",





            ]
        );
        $team = new Team();
        if ($file = $request->file('fileName')) {
            $logo = $file->store('public/images/logo');


            //store your file into directory and db


            $team->logo = $logo;
        }
        $team->name = $request->name;
        $team->stadium_id = $request->stadium_id;
        $team->shirt_color = $request->shirt_color;
        $team->group_id = $request->group_id;
        $team->save();



        return response()->json($team, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $team = Team::with(['players','stadium','group','events','account_odds','matchs'])->findOrFail($id);
        return response()->json($team);
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
                "stadium_id" => 'sometimes|required',

                'fileName' => 'sometimes|image',
                "shirt_color" => "sometimes|required",
                "group_id" => "sometimes|required",





            ]
        );
        $team = Team::findOrFail($id);
        $logo=$team->logo;
        if ($file = $request->file('fileName')) {
            $logo = $file->store('public/images/logo');

            Storage::delete('/public/images/logo'.$team->logo);
            //store your file into directory and db


            $team->logo = $logo;
        }
        $request->merge(
            ["logo"=>$logo]
        );
        $team->update($request->all());



        return response()->json(
            [
                'message' => 'Team updated',
                'data' => $team
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
        $team = Team::findOrFail($id);

        $image_path = "public/images/logo";  // Value is not URL but directory file path
        if ($team->logo) {
           // $team->logo::delete($image_path);
            Storage::delete('/public/images/logo'.$team->logo);
        }
        $team->delete();
        return response()->json(
            [
                'message' => 'team deleted',
                'data' => $team
            ]
        );
    }
}
