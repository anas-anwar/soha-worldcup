<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Hotel extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable=['name','description','phone','rate','latitude','longtude','address','hotel_url'];
    public function rooms(){
        return $this->hasMany(Room::class,'room_id','id');
    }
    public function images(){
        return $this->morphMany(Images::class,'model');
    }    public function services(){
        return $this->morphMany(Service::class,'model');
    }

}
