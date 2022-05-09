<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeOfEvent extends Model
{
    use HasFactory;
    protected $fillable=['event','meaning'];
    public function events(){
        return $this->hasOne(Event::class,'typeOfEvent_id','id');
    }

}
