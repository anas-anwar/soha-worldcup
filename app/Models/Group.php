<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;
    protected $fillable=['name'];
    protected $primaryKey ="group_id";
    public function team(){
        return $this->belongsTo(Team::class,'group_id','id');
    }
}
