<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Blade;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::directive('currency', function ($expression) {
            return "Rp. <?php echo number_format($expression, 0, ',', '.'); ?>";
        });
        date_default_timezone_set('Asia/Jakarta');
    }
    function indo_date($date) {
        $d = substr($date,8,2);
        $m = substr($date,5,2);
        $y = substr($date,0,4);
        return $d.'/'.$m.'/'.$y;
    }
}
