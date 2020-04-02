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

Route::get('/highlights/', function (InstagramHighlightsInterface $inst) {
    $highlights = $inst->getHighlights(auth()->user()->instagramAccount);
    dump($highlights);
    if (auth()->check()) {
        $user = auth()->user();
        $user->highlights = $highlights;
        $user->save();
    }
});
Route::get('/test', function (\App\Instagram\InstagramApiAuthentication $apiClient) {
    $user = auth()->user();
    $user->instagramAccount = $apiClient->getNewUser();
    $user->save();
    return ['status' => 'OK'];
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
