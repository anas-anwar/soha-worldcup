<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Room extends Model
{
    use HasFactory;
    use SoftDeletes ;
    protected $fillable=['hotel_id','type','price','url'];
    public function hotel(){
        return $this->belongsTo(Hotel::class,'room_id','id');
    }
}
