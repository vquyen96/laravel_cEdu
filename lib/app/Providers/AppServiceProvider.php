<?php

namespace App\Providers;
use Auth;
use Illuminate\Support\ServiceProvider;
use App\Models\Group;
use App\Models\About;
use App\Models\Account_Request;

use DateTime;

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
