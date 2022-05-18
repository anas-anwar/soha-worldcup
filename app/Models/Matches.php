<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Matches extends Model
{
    use HasFactory;
    protected $tabel = "matches";
    protected $fillable =["date","end","start","round_id","stadium_id","localteam_id",'visitorteam_id'];
    public function events(){
        return $this->hasMany(Event::class,'match_id','id');
    }
    public function account_odds(){
        return $this->hasMany(AccountOdds::class,'match_id','id');
    }
    public function players(){
        return $this->belongsToMany(Player::class,'lines_up','match_id','player_id');
    }
    public function teams(){
        return $this->belongsToMany(Team::class,'lines_up','match_id','team_id');
    }
    public function rounds(){
        return $this->hasMany(Round::class,'round_id','id');
    }
    public function stadium(){
        return $this->belongsTo(Stadium::class,'stadium_id','id');
    }
    public function local_team(){
        return $this->belongsTo(Team::class,'localteam_id','id');
    }
    public function visitor_team(){
        return $this->belongsTo(Team::class,'visitorteam_id','id');
    }
}
