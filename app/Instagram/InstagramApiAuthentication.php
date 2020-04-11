<?php


namespace App\Instagram;


use App\Exceptions\Instagram\InstagramDataException;
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
     * @throws InstagramDataException
     */
    public function getNewUser()
    {
        $this->createNewUser();
        $this->setNewLongLivedAccessToken();
        $businessId = $this->getInstagramBusinessId();
        $this->account->businessId = $businessId;
        $this->account->userId = $this->getInstagramUserId($businessId);

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
     * @throws InstagramLoginException
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
        $this->account->accessToken = json_decode($response)->access_token ?? null;
        if (! $this->account->accessToken) {
            throw new InstagramLoginException(
                'Отсутствуют необходимые данные в ответе сервера на setNewLongLivedAccessToken: ' .
                json_encode($response)
            );
        }
    }

    /**
     * @param null $businessId
     * @return mixed|null
     * @throws InstagramDataException
     * @throws \Facebook\Exceptions\FacebookSDKException
     */
    public function getInstagramUserId($businessId = null)
    {
        if (! $businessId) {
            $businessId = $this->getInstagramBusinessId();
        }
        $response = $this->fb->get(
            '/' . $businessId . '?fields=ig_id',
            $this->account->accessToken
        )->getDecodedBody();
        $igId = $response['ig_id'] ?? null;

        if (! $igId) {
            throw new InstagramDataException(
                'Отсутствуют необходимые данные в ответе сервера на getInstagramUserId: ' .
                json_encode($response)
            );
        }
        return $igId;
    }

    public function getInstagramBusinessId($accountPageId = null)
    {
        if (! $accountPageId) {
            $accountPageId = $this->getFacebookAccountId();
        }
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
