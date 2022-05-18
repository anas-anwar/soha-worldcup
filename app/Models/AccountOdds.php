<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountOdds extends Model
{
    use HasFactory;
    protected $fillable=['vote','match_id','account_id'];
    public function match(){
        return $this->belongsTo(Matches::class,'match_id','id');
    }
    public function account(){
        return $this->belongsTo(Account::class,'account_id','id');
    }
    public function team(){
        return $this->belongsTo(Matchs::class,'vote','id')->default(0);
    }
}
