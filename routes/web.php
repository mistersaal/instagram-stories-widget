<?php

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

Route::post('/instagram', 'InstagramLoginController@login')->name('instagram.login');
Route::delete('/instagram', 'InstagramLoginController@logout')->name('instagram.logout');

Route::patch('/instagram/data', 'InstagramDataController@update')->name('instagram.data.update');

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
