<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

use App\Post;
use App\Policies\PostPolicy;
use App\Permission;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
        Post::class => PostPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define(
            'update-post', 
            function ($user, $post) {
                return $user->id == $post->user_id;
            }
        );

        Gate::define(
            'is-admin', function ($user) {
                foreach ($user->roles as $role) {
                    if ($role->name == 'Admin') {
                        return true;
                    }
                }
            }
        );
        
        foreach ($this->getPermissions() as $permission) {
            Gate::define(
                $permission->slug, 
                function ($user) use ($permission) {
                    return $user->hasRole($permission->roles);
                }
            );
        }
    }
    
    private function getPermissions()
    {
        return Permission::all();
    }
}
