<?php

use Faker\Guesser\Name;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//home
Route::get('/', function () {
    return view('frontend.index');
});

//about
Route::get('/about', function () {
    return view('frontend.about');
});

//fitur
Route::get('/produk', function () {
    return view('frontend.products');
});

//login
Route::get('/login', [App\Http\Controllers\LoginController::class, 'index'])->name('login');

Route::group(['middleware' => ['auth']], function () {

    //dashboard admin dan manajer
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    //dashboard pegawai
    Route::get('/home/{id_gudang}', [App\Http\Controllers\HomeController::class, 'indexPegawai'])->name('homePegawai')->middleware('middlewarePegawai');

    //menu gudang
    Route::get('/menugudang', 'App\Http\Controllers\MenuGudangController@index')->name('menugudang')->middleware('middlewarePegawai');

    //change password
    Route::get('/change-password', 'App\Http\Controllers\PasswordController@changePassword')->name('change-password');
    Route::post('/update-password', 'App\Http\Controllers\PasswordController@updatePassword')->name('update-password');

    //cek exp produk
    Route::prefix('products')->group(function () {
        Route::get('', [App\Http\Controllers\ExpiredController::class, 'products'])->name('products');
        Route::get('expiryCheck', [App\Http\Controllers\ExpiredController::class, 'product_expiry_check'])->name('products.expiryCheck');
    });

    Route::group(['middleware' => ['middlewareManajer']], function () {

        //laporan stok barang
        Route::get('/laporanStok', 'App\Http\Controllers\LaporanStokController@index');
        Route::get('/stokBarang/cetak', 'App\Http\Controllers\LaporanStokController@cetakStok');
        Route::get('/laporanStokPertanggal/cetak', 'App\Http\Controllers\LaporanStokController@CetakStokPertanggal');
        // Route::get('/laporanStokPertanggal/{tglawal}/{tglakhir}', 'App\Http\Controllers\LaporanStokController@CetakStokPertanggal');
        
        //laporan barang masuk
        Route::get('/laporanMasuk', 'App\Http\Controllers\LaporanMasukController@index');
        Route::get('/BarangMasuk/cetak', 'App\Http\Controllers\LaporanMasukController@cetakBarangMasuk')->name('BarangMasuk.cetak');
        Route::get('/laporanMasukPertanggal/cetak', 'App\Http\Controllers\LaporanMasukController@CetakMasukPertanggal');
        // Route::get('/laporanMasukPertanggal/{tglawal}/{tglakhir}', 'App\Http\Controllers\LaporanMasukController@CetakMasukPertanggal');
        
        //laporan barang keluar
        Route::get('/laporanKeluar', 'App\Http\Controllers\LaporanKeluarController@index');
        Route::get('/BarangKeluar/cetak', 'App\Http\Controllers\LaporanKeluarController@cetakBarangKeluar');
        Route::get('/laporanKeluarPertanggal/cetak', 'App\Http\Controllers\LaporanKeluarController@CetakKeluarPertanggal');
        // Route::get('/laporanKeluarPertanggal/{tglawal}/{tglakhir}', 'App\Http\Controllers\LaporanKeluarController@CetakKeluarPertanggal');
    });

    //hak akses admin
    Route::group(['middleware' => ['middlewareAdmin']], function () {

        //users
        Route::get('/user', 'App\Http\Controllers\UserController@index')->name('user.index');
        Route::get('user/list', [UserController::class, 'getUser'])->name('user.list');
        Route::get('/user/create', 'App\Http\Controllers\UserController@create');
        Route::get('/user/{pegawai}', 'App\Http\Controllers\UserController@show');
        Route::post('/user', 'App\Http\Controllers\UserController@store')->name('user.store');
        Route::delete('/user/{user}', 'App\Http\Controllers\UserController@destroy');
        Route::get('/user/{user}/edit', 'App\Http\Controllers\UserController@edit');
        Route::patch('/user/{user}', 'App\Http\Controllers\UserController@update');
        Route::get('/user/status/{user}', 'App\Http\Controllers\UserController@status');

        //jenis
        Route::get('/jenis', 'App\Http\Controllers\JenisBarangController@index')->name('jenis.index');
        Route::get('/jenis/create', 'App\Http\Controllers\JenisBarangController@create');
        Route::get('/jenis/{jenisBarang}/show', 'App\Http\Controllers\JenisBarangController@show');
        Route::post('/jenis', 'App\Http\Controllers\JenisBarangController@store')->name('jenis.store');
        Route::delete('/jenis/{jenis}', 'App\Http\Controllers\JenisBarangController@destroy');
        Route::get('/jenis/{jenisBarang}/edit', 'App\Http\Controllers\JenisBarangController@edit');
        Route::patch('/jenis/{jenisBarang}', 'App\Http\Controllers\JenisBarangController@update');

        //satuan barang
        Route::get('/satuan', 'App\Http\Controllers\SatuanBarangController@index');
        Route::get('/satuan/create', 'App\Http\Controllers\SatuanBarangController@create');
        Route::get('/satuan/{satuanBarang}/show', 'App\Http\Controllers\SatuanBarangController@show');
        Route::post('/satuan', 'App\Http\Controllers\SatuanBarangController@store');
        Route::delete('/satuan/{satuanBarang}', 'App\Http\Controllers\SatuanBarangController@destroy');
        Route::get('/satuan/{satuanBarang}/edit', 'App\Http\Controllers\SatuanBarangController@edit');
        Route::patch('/satuan/{satuanBarang}', 'App\Http\Controllers\SatuanBarangController@update');

        //data barang
        Route::get('/dataBarang', 'App\Http\Controllers\DataBarangController@index')->name('dataBarang.index');
        Route::get('/dataBarang/create', 'App\Http\Controllers\DataBarangController@create');
        Route::post('/dataBarang', 'App\Http\Controllers\DataBarangController@store');
        Route::delete('/dataBarang/{dataBarang}', 'App\Http\Controllers\DataBarangController@destroy');
        Route::get('/dataBarang/{dataBarang}/edit', 'App\Http\Controllers\DataBarangController@edit');
        Route::patch('/dataBarang/{dataBarang}', 'App\Http\Controllers\DataBarangController@update');

        //supplier
        Route::get('/supplier', 'App\Http\Controllers\SupplierController@index')->name('supplier.index');
        Route::get('/supplier/create', 'App\Http\Controllers\SupplierController@create');
        Route::post('/supplier', 'App\Http\Controllers\SupplierController@store');
        Route::delete('/supplier/{supplier}', 'App\Http\Controllers\SupplierController@destroy');
        Route::get('/supplier/{supplier}/edit', 'App\Http\Controllers\SupplierController@edit');
        Route::patch('/supplier/{supplier}', 'App\Http\Controllers\SupplierController@update')->name('supplier.update');

        //data gudang
        Route::get('/gudang', 'App\Http\Controllers\GudangController@index')->name('gudang.index');
        Route::get('/gudang/create', 'App\Http\Controllers\GudangController@create');
        Route::post('/gudang', 'App\Http\Controllers\GudangController@store');
        Route::delete('/gudang/{gudang}', 'App\Http\Controllers\GudangController@destroy');
        Route::get('/gudang/{gudang}/edit', 'App\Http\Controllers\GudangController@edit');
        Route::patch('/gudang/{gudang}', 'App\Http\Controllers\GudangController@update')->name('gudang.update');
    });

    //hak akses pegawai
    Route::group(['middleware' => ['middlewarePegawai']], function () {

        //stok barang
        Route::get('/stokBarang/{id_gudang}', 'App\Http\Controllers\StokBarangController@index')->name('stok.index');
        Route::get('/stokBarang/{id_gudang}/create', 'App\Http\Controllers\StokBarangController@create');
        Route::post('/stokBarang', 'App\Http\Controllers\StokBarangController@store');
        Route::delete('/stokBarang/{stokBarang}', 'App\Http\Controllers\StokBarangController@destroy')->name('stok.destroy');
        Route::get('/stokBarang/{stokBarang}/edit', 'App\Http\Controllers\StokBarangController@edit')->name('stok.edit');
        Route::patch('/stokBarang/{stokBarang}', 'App\Http\Controllers\StokBarangController@update');

        // barang masuk
        Route::get('/BarangMasuk/{id_gudang}', 'App\Http\Controllers\BarangMasukController@index');
        Route::get('/BarangMasuk/{id_gudang}/create', 'App\Http\Controllers\BarangMasukController@create');
        Route::post('/BarangMasuk', 'App\Http\Controllers\BarangMasukController@store');
        Route::delete('/BarangMasuk/{barangMasuk}', 'App\Http\Controllers\BarangMasukController@destroy');
        Route::get('/BarangMasuk/{barangMasuk}/edit', 'App\Http\Controllers\BarangMasukController@edit');
        Route::patch('/BarangMasuk/{barangMasuk}', 'App\Http\Controllers\BarangMasukController@update');

        //barang keluar
        Route::get('/BarangKeluar/{id_gudang}', 'App\Http\Controllers\BarangKeluarController@index');
        Route::get('/BarangKeluar/{id_gudang}/create', 'App\Http\Controllers\BarangKeluarController@create');
        Route::post('/BarangKeluar', 'App\Http\Controllers\BarangKeluarController@store');
        Route::delete('/BarangKeluar/{barangKeluar}', 'App\Http\Controllers\BarangKeluarController@destroy');
        Route::get('/BarangKeluar/{barangKeluar}/edit', 'App\Http\Controllers\BarangKeluarController@edit');
        Route::patch('/BarangKeluar/{barangKeluar}', 'App\Http\Controllers\BarangKeluarController@update');
    });

    //akun
    Route::get('/akun', 'App\Http\Controllers\AkunController@index')->name('setting.akun');
    Route::post('/akunUpdate', 'App\Http\Controllers\AkunController@update')->name('setting.akun.update');

    //ROUTE BARU DISINI//

    //stok barang
    // Route::get('/stokBarang/{id_gudang}', 'App\Http\Controllers\StokBarangController@indexNew');
    // Route::get('/stokBarang/{id_gudang}/create', 'App\Http\Controllers\StokBarangController@createNew');

    // barang masuk
    // Route::get('/BarangMasuk/index/{id_gudang}', 'App\Http\Controllers\BarangMasukController@indexNew');
    // Route::get('/BarangMasuk/{id_gudang}/create', 'App\Http\Controllers\BarangMasukController@createNew');

    // //barang keluar
    // Route::get('/BarangKeluar/index/{id_gudang}', 'App\Http\Controllers\BarangKeluarController@indexNew');
    // Route::get('/BarangKeluar/{id_gudang}/create', 'App\Http\Controllers\BarangKeluarController@createNew');
});

Auth::routes();
