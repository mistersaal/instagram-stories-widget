<?php

use \App\Instagram\Interfaces\InstagramHighlightsInterface;
use App\Instagram\Interfaces\InstagramStoriesInterface;
use App\Instagram\Interfaces\InstagramUserDataInterface;
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
Route::post('/instagram/login', 'InstagramLoginController@login')->name('instagram.login');
Route::delete('/instagram/logout', 'InstagramLoginController@logout')->name('instagram.logout');
Route::get('/stories', function (InstagramStoriesInterface $inst) {
    return $inst->getStories(auth()->user()->instagramAccount);
});
Route::get('/userdata', function (InstagramUserDataInterface $inst) {
    dump($inst->getNickname(auth()->user()->instagramAccount));
    dump($inst->getProfileImage(auth()->user()->instagramAccount));
});

//TODO: сделать middleware instagramAuth

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
