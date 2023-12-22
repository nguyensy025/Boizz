<?php

namespace App\Providers;


// use Illuminate\Support\Facades\Gate;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        // // Category
        // Gate::define('list-category', function ($user) {
        //     return $user->checkPermissionAccess('list_category');
        // });
        // Gate::define('add-category', function ($user) {
        //     return $user->checkPermissionAccess('add-category');
        // });
        // Gate::define('edit-category', function ($user) {
        //     return $user->checkPermissionAccess('edit-category');
        // });
        // Gate::define('delete-category', function ($user) {
        //     return $user->checkPermissionAccess('delete-category');
        // });

        // // Menu
        // Gate::define('list-menu', function ($user) {
        //     return $user->checkPermissionAccess('list_menu');
        // });
        // Gate::define('add-menu', function ($user) {
        //     return $user->checkPermissionAccess('add-menu');
        // });
        // Gate::define('edit-menu', function ($user) {
        //     return $user->checkPermissionAccess('edit-menu');
        // });
        // Gate::define('delete-menu', function ($user) {
        //     return $user->checkPermissionAccess('delete-menu');
        // });

        // // Product
        // Gate::define('list-product', function ($user) {
        //     return $user->checkPermissionAccess('list_product');
        // });
        // Gate::define('add-product', function ($user) {
        //     return $user->checkPermissionAccess('add-product');
        // });
        // Gate::define('edit-product', function ($user) {
        //     return $user->checkPermissionAccess('edit-product');
        // });
        // Gate::define('delete-product', function ($user) {
        //     return $user->checkPermissionAccess('delete-product');
        // });

        // // Slider
        // Gate::define('list-slider', function ($user) {
        //     return $user->checkPermissionAccess('list_slider');
        // });
        // Gate::define('add-slider', function ($user) {
        //     return $user->checkPermissionAccess('add-slider');
        // });
        // Gate::define('edit-slider', function ($user) {
        //     return $user->checkPermissionAccess('edit-slider');
        // });
        // Gate::define('delete-slider', function ($user) {
        //     return $user->checkPermissionAccess('delete-slider');
        // });
    }
}
