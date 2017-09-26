<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    protected $table = 'wt_campaign';

    public function user()
    {
        return $this->belongsTo('App\User');
    }

}


