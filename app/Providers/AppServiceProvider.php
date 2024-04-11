<?php

namespace App\Providers;

use App\Models\Shop;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {

        Gate::define('update-shop', function ($user, $post) {
            return $user->id === $post->user_id;
        });

        Gate::define('delete-shop', function ($user, $shop_id) {
            $shop = Shop::find($shop_id);

            if (!$shop) {
                // Shop with this ID does not exist
                return false;
            }

            return $user->id === $shop->user_id;
        });

        Gate::define('update-product', function ($user, $request) {
            $shop = Shop::find($request->shop_id);
            $user_requesting = User::find($shop->id);

            if (!$user_requesting) {
                // Shop with this ID does not exist
                return false;
            }

            return $user->id === $user_requesting->id;
        });

        Gate::define('delete-product', function ($user, $request) {
            $shop = Shop::find($request->shop_id);
            $user_requesting = User::find($shop->id);
            return $user->id === $user_requesting->id;
        });
    }
}
