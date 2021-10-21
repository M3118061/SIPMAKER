<?php

namespace App\Providers;

use App\Models\StokBarang;
use App\Models\BarangMasuk;
use App\Models\BarangKeluar;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use App\Observers\StokBarangObserver;
use App\Observers\BarangKeluarObserver;
use App\Observers\BarangMasukObserver;

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
        view()->composer('*', function ($view) {

        if(Auth::check()){
            $expReminder = User::where('id',Auth::user()->id)->first();
            $all = StokBarang::pluck('tgl_exp','id_stok');
            $remindCount = 0;
            $expCount = 0;
            foreach ($all as $key => $value) {
                $date = Carbon::createFromFormat('Y-m-d', $value);
                $date1 = Carbon::createFromFormat('Y-m-d', $value)->subDays($expReminder->exp_reminder);
                if (Carbon::now() >= $date1 && $value > Carbon::now()){
                    $remindCount +=1;
                }

                if (Carbon::now() > $value) {
                    $expCount +=1 ;
                }

            }

            $view->with('reminder',$remindCount);
            $view->with('expired',$expCount);
        }
        Schema::defaultStringLength(225);
        Paginator::useBootstrap();
    });

    StokBarang::observe(StokBarangObserver::class);
    BarangMasuk::observe(BarangMasukObserver::class);
    BarangKeluar::observe(BarangKeluarObserver::class);
    }
}
