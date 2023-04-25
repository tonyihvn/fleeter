<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\tasks;
use App\Models\User;
use App\Models\businesses;
use App\Models\businessgroups;
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
                $view->with('mytasks', tasks::where('assigned_to',Auth::user()->id)->get());
                $view->with('clients', User::select('id','name','company_name','role','status')->where('business_id',Auth::user()->business_id)->get());
                $view->with('staff', User::select('id','name','phone_number','status')->where('business_id',Auth::user()->business_id)->get());

                $view->with('userbusinesses',businesses::select('id','business_name','businessgroup_id')->where('user_id',Auth::user()->id)->orWhere('id',Auth()->user()->business_id)->get());

                $view->with('business', businesses::where('id',Auth::user()->business_id)->first());

            }else{
                $view->with('business', businesses::first());
            }

            $view->with('businessgroups', businessgroups::select('id','businessgroup_name')->get());

            // if you need to access in controller and views:
            // Config::set('something', $something);
        });
    }
}
