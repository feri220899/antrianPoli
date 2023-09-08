<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DokterController;
use App\Http\Controllers\PasienController;
use App\Http\Controllers\AntrianPasienController;

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

Route::get('/', [DokterController::class, 'ViewDokter']);
Route::get('/view-pasien', [PasienController::class, 'ViewPasien']);
Route::get('/view-antrian', [AntrianPasienController::class, 'AntrianPasien']);
    Route::get('/view-component-antrian', [AntrianPasienController::class, 'ViewAntrianPasien']);

Route::post('/input-ada', [PasienController::class, 'inputAda']);
Route::post('/input-tidak-ada', [PasienController::class, 'inputTidakAda']);
