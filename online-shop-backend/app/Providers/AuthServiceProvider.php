<?php

namespace App\Providers;
use App\Models\Product;
use App\Models\User;
use App\Models\Category;
use App\Policies\ProductPolicy;
use App\Policies\UserPolicy;
use App\Policies\CategoryPolicy;


// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
         User::class => UserPolicy::class,
         Product::class => ProductPolicy::class,
         Category::class => CategoryPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
         //$this->registerPolicies();

        //
    }
}
