<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContractBilling extends Model
{
    protected $guarded = [];


    public function user()
    {
        return $this->belongsTo('App\User');
    }


    public function convergeCompany()
    {
        return $this->belongsTo('App\ConvergeCompany');
    }


    public function scopeApproved($query)
    {
        return $query->where('approved', 1);
    }
}
