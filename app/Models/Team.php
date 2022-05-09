<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Team extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $primaryKey ="team_id";
    protected $fillable =['name','player_id','stadium_id','logo','shirt_color','group_id'];
    public function players(){
        return $this->hasMany(Player::class,'player_id','id');
    }
    public function stadium(){
        return $this->belongsTo(Stadium::class,'stadium_id','id');
    }
    public function groups(){
        return $this->hasMany(Group::class,'group_id','id');
    }
    public function events(){
        return $this->hasMany(Event::class,'team_id','id');
    }
    public function account_odds(){
        return $this->hasMany(AccountOdds::class,'vote','id');
    }
    public function matchs(){
        return $this->belongsToMany(Matchs::class,'lines_up','team_id','match_id');
    }
}
