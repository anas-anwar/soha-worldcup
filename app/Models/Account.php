<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Account extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable=['UDID','type'];
    public function account_odds(){
        return $this->hasMany(AccountOdds::class,'account_id','id');
    }

}
