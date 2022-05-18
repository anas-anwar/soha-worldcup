<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    use HasFactory;
   
    public $timestamps = false;
    protected $fillable=['player_id','name','nationality','birthdate','height','weight'];
    public function team(){
        return $this->belongsTo(Team::class,'team_id','id');
    }
    public function events(){
        return $this->hasMany(Event::class,'player_id','id');
    }
    public function matchs(){
        return $this->belongsToMany(Matches::class,'lines_up','player_id','match_id');
    }
}
