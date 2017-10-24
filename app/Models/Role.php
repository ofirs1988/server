<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
    protected $table = 'wt_roles';
    protected $fillable = [
        'id','name','slug'
    ];

    protected $hidden = [
        'default_permissions'
    ];

    public function users()
    {
        return $this->belongsToMany('App\User','wt_role_users');
    }

    public function hasAccess(array $permissions){
        foreach ($permissions as $permission){
            if($this->hasPermission($permission))
                return true;
        }
        return false;
    }

    protected function hasPermission($permission)
    {
        $permissions = json_decode($this->permissions,true);
        return $permissions[$permission] ? $permissions[$permission] : false;
    }

}
