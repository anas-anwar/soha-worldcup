<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Round extends Model
{
    use HasFactory;
    
    public $timestamps = false;
    
    protected $fillable=['name'];
    public function match(){
        return $this->belongsTo(Matches::class,'round_id','id');
    }
    
}
