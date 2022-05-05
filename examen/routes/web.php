<?php

use App\Http\Controllers\PeliculaController;
use GuzzleHttp\Promise\Create;
use Illuminate\Support\Facades\Route;


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

Route::get('/', function () {
    return view('welcome');
});
/*
Route::get('/cine', function () {
    return view('cine.index');
});
Route::get('cine/create',[PeliculaController::class,'Create']);
*/
Route::resource('cine',PeliculaController::class);

