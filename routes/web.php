<?php

use App\Http\Controllers\PlayerController;
use Illuminate\Support\Facades\Auth;
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


Auth::routes();
Route::get('', function(){return redirect('players');});




Route::prefix('players')->group(function () {
// Players
Route::get('', 'PlayerController@index');
Route::get('search', 'PlayerController@search')->name('search');
Route::get('players/export/', [PlayerController::class, 'export']);
Route::get('players/export/', 'PlayerController@export')->name('excel');
Route::get('file-import-export', [PlayerController::class, 'fileImportExport'])->name('file-import-export');
Route::post('file-import', [PlayerController::class, 'fileImport'])->name('file-import');




// Auth
Route::group(['middleware' => 'auth'], function(){
    Route::get('create', 'PlayerController@create');


    Route::post('', 'PlayerController@store');
    Route::get('{player}/edit', 'PlayerController@edit');
    Route::put('{player}', 'PlayerController@update');
    Route::delete('{player}', 'PlayerController@destroy');



});

Route::get('{player}', 'PlayerController@show');
});

Route::group(['middleware' => 'admin'], function(){
    Route::get('create', 'PlayerController@create');
    Route::get('create', 'PetController@create');


});

Route::prefix('pets')->group(function () {
// Pets
Route::get('', 'PetController@index');

// Auth
Route::group(['middleware' => 'auth'], function(){


    Route::post('', 'PetController@store');
    Route::get('{pet}/edit', 'PetController@edit');
    Route::put('{pet}', 'PetController@update');
    Route::delete('{pet}', 'PetController@destroy');

});

Route::get('{pet}', 'PetController@show');
});
