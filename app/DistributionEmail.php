<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DistributionEmail extends Model
{
    protected $guarded = [];

    public function distributionLists()
    {
        return $this->belongsToMany('App\DistributionList');
    }
}
