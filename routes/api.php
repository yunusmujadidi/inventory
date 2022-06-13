<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\RoleController;
use App\Http\Controllers\Api\MerekController;
use App\Http\Controllers\Api\BarangController;
use App\Http\Controllers\Api\LokasiController;
use App\Http\Controllers\Api\SupplierController;
use App\Http\Controllers\Api\KategoriController;
use App\Http\Controllers\Api\PermissionController;
use App\Http\Controllers\Api\BarangMasukController;
use App\Http\Controllers\Api\BarangKeluarController;
use App\Http\Controllers\Api\MerekBarangsController;
use App\Http\Controllers\Api\LokasiBarangsController;
use App\Http\Controllers\Api\KategoriBarangsController;
use App\Http\Controllers\Api\KategoriSuppliersController;
use App\Http\Controllers\Api\BarangBarangMasuksController;
use App\Http\Controllers\Api\BarangBarangKeluarsController;
use App\Http\Controllers\Api\LokasiBarangKeluarsController;
use App\Http\Controllers\Api\SupplierBarangMasuksController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/login', [AuthController::class, 'login'])->name('api.login');

Route::middleware('auth:sanctum')
    ->get('/user', function (Request $request) {
        return $request->user();
    })
    ->name('api.user');

Route::name('api.')
    ->middleware('auth:sanctum')
    ->group(function () {
        Route::apiResource('roles', RoleController::class);
        Route::apiResource('permissions', PermissionController::class);

        Route::apiResource('barangs', BarangController::class);

        // Barang Barang Masuk
        Route::get('/barangs/{barang}/barang-masuks', [
            BarangBarangMasuksController::class,
            'index',
        ])->name('barangs.barang-masuks.index');
        Route::post('/barangs/{barang}/barang-masuks', [
            BarangBarangMasuksController::class,
            'store',
        ])->name('barangs.barang-masuks.store');

        // Barang Barang Keluar
        Route::get('/barangs/{barang}/barang-keluars', [
            BarangBarangKeluarsController::class,
            'index',
        ])->name('barangs.barang-keluars.index');
        Route::post('/barangs/{barang}/barang-keluars', [
            BarangBarangKeluarsController::class,
            'store',
        ])->name('barangs.barang-keluars.store');

        Route::apiResource('suppliers', SupplierController::class);

        // Supplier Barang Masuk
        Route::get('/suppliers/{supplier}/barang-masuks', [
            SupplierBarangMasuksController::class,
            'index',
        ])->name('suppliers.barang-masuks.index');
        Route::post('/suppliers/{supplier}/barang-masuks', [
            SupplierBarangMasuksController::class,
            'store',
        ])->name('suppliers.barang-masuks.store');

        Route::apiResource('barang-masuks', BarangMasukController::class);

        Route::apiResource('barang-keluars', BarangKeluarController::class);

        Route::apiResource('kategoris', KategoriController::class);

        // Kategori Barang
        Route::get('/kategoris/{kategori}/barangs', [
            KategoriBarangsController::class,
            'index',
        ])->name('kategoris.barangs.index');
        Route::post('/kategoris/{kategori}/barangs', [
            KategoriBarangsController::class,
            'store',
        ])->name('kategoris.barangs.store');

        // Kategori Supplier
        Route::get('/kategoris/{kategori}/suppliers', [
            KategoriSuppliersController::class,
            'index',
        ])->name('kategoris.suppliers.index');
        Route::post('/kategoris/{kategori}/suppliers', [
            KategoriSuppliersController::class,
            'store',
        ])->name('kategoris.suppliers.store');

        Route::apiResource('lokasis', LokasiController::class);

        // Lokasi Barang
        Route::get('/lokasis/{lokasi}/barangs', [
            LokasiBarangsController::class,
            'index',
        ])->name('lokasis.barangs.index');
        Route::post('/lokasis/{lokasi}/barangs', [
            LokasiBarangsController::class,
            'store',
        ])->name('lokasis.barangs.store');

        // Lokasi Barang Keluar
        Route::get('/lokasis/{lokasi}/barang-keluars', [
            LokasiBarangKeluarsController::class,
            'index',
        ])->name('lokasis.barang-keluars.index');
        Route::post('/lokasis/{lokasi}/barang-keluars', [
            LokasiBarangKeluarsController::class,
            'store',
        ])->name('lokasis.barang-keluars.store');

        Route::apiResource('mereks', MerekController::class);

        // Merek Barang
        Route::get('/mereks/{merek}/barangs', [
            MerekBarangsController::class,
            'index',
        ])->name('mereks.barangs.index');
        Route::post('/mereks/{merek}/barangs', [
            MerekBarangsController::class,
            'store',
        ])->name('mereks.barangs.store');

        Route::apiResource('users', UserController::class);
    });
