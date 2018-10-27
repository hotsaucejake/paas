<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DistributionList extends Model
{
    protected $guarded = [];


    public function distributionEmails()
    {
        return $this->belongsToMany('App\DistributionEmail');
    }
}
