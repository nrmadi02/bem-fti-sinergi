<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\ServiceProvider;

class MenuServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot(Guard $auth)
    {
        // get all data from menu.json file

         // Share all menuData to all the views
         view()->composer('*', function($view) use ($auth) {

            $count_unverifuser = User::where('is_verified', 0)->get()->count();

            $verticalMenuJson = file_get_contents(base_path('resources/data/menu-data/verticalMenu.json'));
            $verticalMenuData = json_decode($verticalMenuJson);
            $horizontalMenuJson = file_get_contents(base_path('resources/data/menu-data/horizontalMenu.json'));
            $horizontalMenuData = json_decode($horizontalMenuJson);
            $verticalMenuJsonaAdmin = file_get_contents(base_path('resources/data/menu-data/verticalMenuAdmin.json'));
            $verticalMenuDataAdmin = json_decode($verticalMenuJsonaAdmin, true);
            $horizontalMenuJsonAdmin = file_get_contents(base_path('resources/data/menu-data/horizontalMenuAdmin.json'));
            $horizontalMenuDataAdmin = json_decode($horizontalMenuJsonAdmin);

            foreach ($verticalMenuDataAdmin['menu'] as $key => $value) {
                if(isset($value['name'])){
                    if ($value['name'] == "Verified User"){
                        if($count_unverifuser != 0){
                            $verticalMenuDataAdmin['menu'][$key]['badge'] = (string)$count_unverifuser;
                        }
                    }
                }
            }

            $encodeDataMenuAdmin = json_encode($verticalMenuDataAdmin);
            $newVerticalMenuDataAdmin = json_decode($encodeDataMenuAdmin);

            if($auth->check()){
                if($auth->user()->role == "admin"){
                    \View::share('menuData',[$newVerticalMenuDataAdmin, $horizontalMenuDataAdmin]);
                }

                if($auth->user()->role == "anggota"){
                    \View::share('menuData',[$verticalMenuData, $horizontalMenuData]);
                }
            }
         });
    }
}
