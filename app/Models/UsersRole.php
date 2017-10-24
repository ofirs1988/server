<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UsersRole extends Model
{
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
    protected $table = "wt_role_users";
    protected $fillable = ['user_id','role_id', 'permissions'];
}


