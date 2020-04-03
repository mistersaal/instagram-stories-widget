<?php


namespace App\Instagram;


use App\Instagram\Interfaces\InstagramStoriesInterface;
use App\User;
use Illuminate\Support\Facades\Cache;

class InstagramWidgetData
{
    public function getCachedWidgetData($id)
    {
        return Cache::get($id, function () use ($id) {
            $data = $this->getWidgetData($id);
            if (is_array($data)) {
                Cache::put(
                    $id,
                    $data,
                    now()->addMinutes(config('instagram.cacheMinutes'))
                );
            }
            return $data;
        });
    }

    public function getWidgetData($id)
    {
        $user = User::find($id);
        if (! $user) {
            return back()->withErrors(['hash' => 'The hash field is invalid']);
        }

        $highlights = $user->highlights;
        $stories = resolve(InstagramStoriesInterface::class)
            ->getStories($user->instagramAccount);
        $userData = $user->instagramAccount->getPublicData();

        return compact('highlights', 'stories', 'userData');
    }
}
