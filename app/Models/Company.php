<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $table = 'wt_company';

    protected $fillable = [
        'id','name','email','contact_name','phone','logo','active','type','op','type_pay','site',           'social_page'
    ];


}
