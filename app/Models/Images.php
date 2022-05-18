<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Images extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable=['model_type','model_id','name','image_url'];
    public function model(){
        return $this->morphTo();
    }
}
