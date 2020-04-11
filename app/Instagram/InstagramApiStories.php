<?php


namespace App\Instagram;


use App\Exceptions\Instagram\InstagramDataException;
use App\Instagram\Interfaces\InstagramStoriesInterface;
use Illuminate\Support\Collection;

class InstagramApiStories
    extends InstagramBaseApiClient
    implements InstagramStoriesInterface
{
    /**
     * @inheritDoc
     * @throws \Facebook\Exceptions\FacebookSDKException
     * @throws InstagramDataException
     */
    public function getStories(InstagramAccount $account): Collection
    {
        $response = $this->fb->get(
            '/' . $account->businessId . '/stories?fields=media_url,media_type',
            $account->accessToken
        )->getDecodedBody(); //TODO: может быть ошибка accessToken
        $storiesData = $response['data'] ?? null;
        if (! $storiesData) {
            throw new InstagramDataException(
                'Отсутствуют необходимые данные в ответе сервера на getStories: ' .
                json_encode($response)
            );
        }
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
