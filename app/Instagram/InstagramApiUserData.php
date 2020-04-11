<?php


namespace App\Instagram;


use App\Instagram\Interfaces\InstagramUserDataInterface;

class InstagramApiUserData
    extends InstagramBaseApiClient
    implements InstagramUserDataInterface
{
    private $userData;

    /**
     * @inheritDoc
     * @throws \Facebook\Exceptions\FacebookSDKException
     */
    public function getNickname(InstagramAccount $account): string
    {
        return $this->getData($account)['username'];
    }

    /**
     * @inheritDoc
     * @throws \Facebook\Exceptions\FacebookSDKException
     */
    public function getProfileImage(InstagramAccount $account): ?string
    {
        return $this->getData($account)['profile_picture_url'] ?? null;
    }

    /**
     * @param InstagramAccount $account
     * @return array
     * @throws \Facebook\Exceptions\FacebookSDKException
     */
    private function getData(InstagramAccount $account): array
    {
        if (isset($this->userData[$account->businessId])) {
            return $this->userData[$account->businessId];
        }
        return $this->userData[$account->businessId] = $this->fb->get(
            '/' . $account->businessId . '?fields=username,profile_picture_url',
            $account->accessToken
        )->getDecodedBody();//TODO: может быть ошибка accessToken (Facebook\Exceptions\FacebookAuthenticationException)
    }
}
