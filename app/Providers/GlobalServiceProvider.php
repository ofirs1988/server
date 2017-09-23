<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


class GlobalServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->db_prefix();
    }


    public function db_prefix(){
        //define('ProfilePicDefault',app_path().'/assets/images/user.png');
        //define('DB_PREFIX_USER',"root");
        //define('DB_PREFIX_PAYMENT',"doorbillv1_n_payment_");
        //define('DB_PREFIX_STORAGE',"doorbillv1_n_storage_");
        //define('DB_PREFIX_MAINTENANCE',"doorbillv1_n_maintenance_");
        //define('DB_PREFIX_GENERAL',"doorbillv1_n_general_");
        //define('FIREBASE_URL','https://com-doorbill-neighbor.firebaseio.com/');
       // define('FIREBASE_TOKEN','Slk32pZHXzDc6odBBZKmbN23er8HCDVrTFnbnMwS');


        //dd(app_path() . '\Helpers\Global.php');
    }

}
