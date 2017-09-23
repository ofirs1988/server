<?php

namespace App\Providers;

use App\Videos;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        $this->registerVideoPolicies();

        //
    }

    public function registerVideoPolicies()
    {
        Gate::define('create-post',function ($user){
            $user->hasAccess(['create-post']);
        });
        Gate::define('update-post',function ($user , \App\Videos $video){
            $user->hasAccess(['update-post']) or $user->id == $video->uid;
        });
        Gate::define('publish-post',function ($user){
            $user->hasAccess(['publish-post']);
        });
        Gate::define('see-all-drafts',function ($user){
            $user->inRole(['editor']);
        });
    }
}
