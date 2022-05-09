<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Round extends Model
{
    use HasFactory;
    protected $fillable=['name','start','end'];
    public function match(){
        return $this->belongsTo(Matchs::class,'round_id','id');
    }
    
}
