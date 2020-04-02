<?php

use \App\Instagram\Interfaces\InstagramHighlightsInterface;
use App\Instagram\Interfaces\InstagramStoriesInterface;
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

Route::get('/highlights', function (InstagramHighlightsInterface $inst) {
    $highlights = $inst->getHighlights(auth()->user()->instagramAccount);
    if (auth()->check()) {
        $user = auth()->user();
        $user->highlights = $highlights;
        $user->save();
    }
    return $highlights;
});
Route::get('/test', function (\App\Instagram\InstagramApiAuthentication $apiClient) {
    $user = auth()->user();
    $user->instagramAccount = $apiClient->getNewUser();
    $user->save();
    return ['status' => 'OK'];
});
Route::get('/stories', function (InstagramStoriesInterface $inst) {
    return $inst->getStories(auth()->user()->instagramAccount);
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
