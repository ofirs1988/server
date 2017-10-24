<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Role;

class User extends Authenticatable
{
    use Notifiable;
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
    protected $table = "wt_users";
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id','name', 'email','active'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function roles()
    {
        return $this->belongsToMany('App\Role','wt_role_users');
    }

    public function usersInfo()
    {
        return $this->hasOne('App\UserIfno','user_id');
    }

    public function campaign()
    {
        return $this->hasOne('App\Campaign','uid');
    }

    public function usersCompany()
    {
        return $this->belongsToMany('App\Company','wt_company_users');
    }

    public function hasAccess(array $permissions){
        foreach ($this->roles as $role){
            if($role->hasAccess($permissions))
                return true;
        }
        return false;
    }

    public function ActiveUser($id,$active){

        $user =  User::find($id);
        $user->active = $active;
        if($user->save())
            return $user->id;
    }

}
