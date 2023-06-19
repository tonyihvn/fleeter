<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\tasks;
use App\Models\User;
use App\Models\settings;
use Auth;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // App::bind('path.public', function() {
        //     return base_path().'/public_html';
        // });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('*',function($view) {

            if (Auth::check())
            {
                $view->with('login_user', Auth::user());
                $view->with('mytasks', tasks::where('assigned_to',Auth::user()->id)->orWhere('sender_id',Auth::user()->id)->get());
                $view->with('users', User::select('id','name','phone_number','facility_id','status','role')->get());

            }else{
            $view->with('users', User::select('id','name','phone_number','status','role')->get());
            }
            $view->with('organization', settings::all()->first());

            // if you need to access in controller and views:
            // Config::set('something', $something);
        });
    }
}
