<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Resturent extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable=['name','hour_open','phone','rate','latitude','longtude','address','hour_close'];
    public function images(){
        return $this->morphMany(Images::class,'model');
    }    public function services(){
        return $this->morphMany(Service::class,'model');
    }
}
