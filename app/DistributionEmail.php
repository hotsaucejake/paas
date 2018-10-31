<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class DistributionEmail extends Model
{
    use Notifiable;

    protected $guarded = [];

    
    public function distributionLists()
    {
        return $this->belongsToMany('App\DistributionList');
    }
}
