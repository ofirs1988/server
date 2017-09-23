<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Videos extends Model
{
    protected $table = 'wt_videos';

    protected $fillable = [
        'company_id','uid','src','name','poster','subtitle','type','theme','totalTime',
        'clicks','sound'
    ];
}
