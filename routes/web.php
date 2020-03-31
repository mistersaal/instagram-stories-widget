<?php

use \App\Instagram\Interfaces\InstagramHighlightsInterface;
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

Route::get('/highlights/{id}', function (InstagramHighlightsInterface $inst, $id) {
    $highlights = $inst->getHighlights(new \App\Instagram\InstagramAccount(['userId' => $id]));
    dump($highlights);
    if (auth()->check()) {
        $user = auth()->user();
        $user->highlights = $highlights;
        $user->save();
    }
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
