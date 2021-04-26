<?php

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

Route::get('/', 'App\Http\Controllers\SearchController@index')->name('search');
Route::get('/search/{term}', 'App\Http\Controllers\SearchController@search')->name('searchPost');
Route::get('/view/{term}', function ($param) {
    $model = \App\Models\Translation::find($param);
    if (!$model) {
        $model = \App\Models\Translation::whereEnglish($param)->first();
    }
    return view('word', [
        'model' => $model,
        'term' => $param
    ]);
})->name('view');

Route::get('/contribute', 'App\Http\Controllers\ContributeController@index')->name('contribute');
Route::post('/contribute', 'App\Http\Controllers\ContributeController@submit')->name('contribute.submit');
Route::get('/discover', 'App\Http\Controllers\DiscoverController@index')->name('discover');
Route::get('/discover/{tag}', 'App\Http\Controllers\DiscoverController@tagged')->name('discover.tagged');
Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
