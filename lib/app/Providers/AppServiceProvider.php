<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Group;
use App\Models\About;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $data['group'] = Group::all();
        $data['about_list'] = About::all();
        view()->share($data);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
