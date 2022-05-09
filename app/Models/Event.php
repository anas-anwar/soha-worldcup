<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;
    protected $fillable=['match_id','team_id','player_id','typeOfEvent_id'];
    public function match(){
        return $this->belongsTo(Matchs::class,'match_id','id');
    }
    public function player(){
        return $this->belongsTo(Player::class,'player_id','id');
    }
    public function team(){
        return $this->belongsTo(Team::class,'team_id','id');
    } 
    public function type_of_event(){
        return $this->belongsTo(Team::class,'team_id','id');
    }
}
