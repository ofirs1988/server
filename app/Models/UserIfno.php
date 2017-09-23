<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserIfno extends Model
{

    protected $table = 'wt_usersinfo';
    protected $fillable = ['uid','age','city','address','hometown','education','gender','website','work'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
