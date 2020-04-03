<?php

namespace App\Http\Controllers;

use App\Instagram\Interfaces\InstagramHighlightsInterface;
use App\Instagram\Interfaces\InstagramUserDataInterface;
use Illuminate\Http\Request;

class InstagramDataController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function update(InstagramUserDataInterface $userData, InstagramHighlightsInterface $highlights)
    {
        $user = auth()->user();
        $user->instagramAccount->nickname = $userData->getNickname($user->instagramAccount);
        $user->instagramAccount->image = $userData->getProfileImage($user->instagramAccount);
        $user->highlights = $highlights->getHighlights($user->instagramAccount);
        $user->save();

        return ['status' => 'OK'];
    }
}
