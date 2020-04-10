<?php

namespace App\Http\Controllers;

use App\Instagram\InstagramApiAuthentication;
use App\Instagram\InstagramApiUserData;
use App\Instagram\InstagramWidgetData;
use App\Instagram\Interfaces\InstagramUserDataInterface;
use Illuminate\Http\Request;

class InstagramLoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('verified');
        $this->middleware('instagram.auth', ['only' => ['logout']]);
    }

    public function login(InstagramApiAuthentication $instAuth, InstagramUserDataInterface $userData)
    {
        $user = auth()->user();
        $user->instagramAccount = $instAuth->getNewUser();
        $user->instagramAccount->nickname = $userData->getNickname($user->instagramAccount);
        $user->instagramAccount->image = $userData->getProfileImage($user->instagramAccount);
        $user->save();

        return ['status' => 'OK'];
    }

    public function logout(InstagramWidgetData $data)
    {
        $user = auth()->user();
        $user->instagramAccount = null;
        $user->highlights = null;
        $user->save();
        $data->clearCache($user->_id);

        return ['status' => 'OK'];
    }
}
