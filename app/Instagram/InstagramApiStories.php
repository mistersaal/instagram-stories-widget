<?php


namespace App\Instagram;


use App\Instagram\Interfaces\InstagramStoriesInterface;
use Illuminate\Support\Collection;

class InstagramApiStories
    extends InstagramBaseApiClient
    implements InstagramStoriesInterface
{
    /**
     * @inheritDoc
     * @throws \Facebook\Exceptions\FacebookSDKException
     */
    public function getStories(InstagramAccount $account): Collection
    {
        $storiesData =  $this->fb->get(
            '/' . $account->businessId . '/stories?fields=media_url,media_type',
            $account->accessToken
        )->getDecodedBody()['data']; //TODO: может быть ошибка
        $stories = new Collection();
        foreach ($storiesData as $storyData) {
            $stories->push(new Story([
                'url' => $storyData['media_url'],
                'isVideo' => $storyData['media_type'] === 'VIDEO'
            ]));
        }
        return $stories;
    }
}
