<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Stadium extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable=['name','description','phone','capacity','latitude','longtude','address'];
    public function images(){
        return $this->morphMany(Images::class,'model');
    }
    public function teams(){
        return $this->hasOne(Team::class,'staduim_id','id');
    }
    public function matchs(){
        return $this->hasMany(Matchs::class,'staduim_id','id');
    }  
}
