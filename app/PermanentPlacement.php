<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PermanentPlacement extends Model
{
    protected $guarded = [];


    public function user()
    {
        return $this->belongsTo('App\User');
    }
    

    public function scopeApproved($query)
    {
        return $query->where('approved', 1);
    }
}
