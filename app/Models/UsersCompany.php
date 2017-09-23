<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UsersCompany extends Model
{
    protected $table = 'wt_company_users';

    protected $fillable = [
        'company_id','user_id'
    ];
}
