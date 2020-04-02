<?php


namespace App\Instagram;


use App\Exceptions\Instagram\InstagramLoginException;

class InstagramApiAuthentication extends InstagramBaseApiClient
{
    private $account;

    /**
     * InstagramApiAuthentication constructor.
     * @param InstagramAccount|null $account
     * @param array $config
     * @throws \Facebook\Exceptions\FacebookSDKException
     */
    public function __construct(InstagramAccount $account = null, array $config = [])
    {
        parent::__construct($config);
        $this->account = $account;
    }

    /**
     * @return InstagramAccount|null
     * @throws InstagramLoginException
     * @throws \Facebook\Exceptions\FacebookSDKException
     */
    public function getNewUser()
    {
        $this->createNewUser();
        $this->setNewLongLivedAccessToken();
        $this->account->userId = $this->getInstagramUserId();

        return $this->account;
    }

    /**
     * @throws InstagramLoginException
     * @throws \Facebook\Exceptions\FacebookSDKException
     */
    private function createNewUser()
    {
        $this->account = new InstagramAccount();
        $this->account->accessToken = $this->fb->getJavaScriptHelper()->getAccessToken();
        if (! $this->account->accessToken) {
            throw new InstagramLoginException('Отсутствует accessToken при авторизации');
        }
        $this->account->accessToken = $this->account->accessToken->getValue();
    }

    /**
     * @return void
     * @throws \Facebook\Exceptions\FacebookSDKException
     */
    public function setNewLongLivedAccessToken()
    {
        $response = $this->fb->sendRequest(
            'GET',
            'oauth/access_token',
            [
                'grant_type' => 'fb_exchange_token',
                'client_id' => $this->appId,
                'client_secret' => $this->appSecret,
                'fb_exchange_token' => $this->account->accessToken
            ],
            $this->account->accessToken
        )->getBody();
        $this->account->accessToken = json_decode($response)->access_token; //TODO: тут тоже может быть ошибка
    }

    public function getInstagramUserId()
    {
        $businessId = $this->getInstagramBusinessId();
        return $this->fb->get(
                '/' . $this->getInstagramBusinessId() . '?fields=ig_id',
                $this->account->accessToken
            )->getDecodedBody()['ig_id']; //TODO: тут тоже может быть ошибка
    }

    public function getInstagramBusinessId()
    {
        $accountPageId = $this->getFacebookAccountId();
        $businessAccount = $this->fb->get(
            '/' . $accountPageId . '?fields=instagram_business_account',
            $this->account->accessToken
        );
        return $businessAccount->getDecodedBody()['instagram_business_account']['id']; //TODO: может отсутствовать бизнес аккаунт
    }

    public function getFacebookAccountId()
    {
        $accounts = $this->fb->get('/me/accounts', $this->account->accessToken); //TODO: может быть несколько аккаунтов или 0.
        $accountPageId = $accounts->getDecodedBody()['data'][0]['id'];
        return $accountPageId;
    }
}
