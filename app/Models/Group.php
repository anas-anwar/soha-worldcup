<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;
    protected $fillable=['name'];
    public $timestamps = false;
   
    public function team(){
        return $this->hasMany(Team::class,'group_id','id');
    }
}
