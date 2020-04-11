<?php


namespace App\Instagram;


use App\Exceptions\Instagram\InstagramWidgetException;
use App\Instagram\Interfaces\InstagramStoriesInterface;
use App\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

class InstagramWidgetData
{
    /**
     * @param $id
     * @return mixed
     */
    public function getCachedWidgetData($id)
    {
        return Cache::get($id, function () use ($id) {
            $data = $this->getWidgetData($id);
            Cache::put(
                $id,
                $data,
                now()->addMinutes(config('instagram.cacheMinutes'))
            );
            return $data;
        });
    }

    /**
     * @param $id
     * @return array
     * @throws InstagramWidgetException
     */
    public function getWidgetData($id)
    {
        $user = User::find($id);
        if (! $user) {
            throw new InstagramWidgetException('Hash is invalid.');
        }
        if (! $user->instagramAccount) {
            throw new InstagramWidgetException('Instagram account is not connected.');
        }

        $highlights = $user->highlights ?? new Collection();
        $stories = resolve(InstagramStoriesInterface::class)
            ->getStories($user->instagramAccount);
        $userData = $user->instagramAccount->getPublicData();

        return compact('highlights', 'stories', 'userData');
    }

    public function clearCache($id)
    {
        Cache::forget($id);
    }
}
