<?php

namespace App\Instagram;


use App\Exceptions\Instagram\InstagramLoginException;
use App\Exceptions\Instagram\InstagramQueryException;
use GuzzleHttp\Client;
use GuzzleHttp\Cookie\CookieJar;
use Illuminate\Support\Facades\Cache;

class InstagramBaseWebClient
{
    private $login;
    private $password;
    private $userAgent;
    protected $baseUrl;

    /** @var CookieJar */
    protected $cookies;
    /** @var Client */
    protected $client;

    /**
     * InstagramBaseWebClient constructor.
     * @param $login
     * @param $password
     * @throws InstagramLoginException
     */
    public function __construct(string $login = null, string $password = null)
    {
        $this->login = $login ?? config('instagram.auth.login');
        $this->password = $password ?? config('instagram.auth.password');
        $this->userAgent = config('instagram.auth.userAgent');
        $this->baseUrl = config('instagram.baseUrl');
        $this->client = new Client([
            'headers' => [
                'User-Agent' => $this->userAgent,
                'Referer' => $this->baseUrl
            ],
            'base_uri' => $this->baseUrl
        ]);

        $this->login();
    }

    /**
     * Login instagram
     * @param bool $noCache
     * @throws InstagramLoginException
     */
    protected function login(bool $noCache = false)
    {
        if (Cache::has('cookies') && ! $noCache) {
            $this->cookies = Cache::get('cookies');
            return;
        }

        $this->cookies = new CookieJar();
        $this->client->request('GET', '/', [
            'cookies' => $this->cookies
        ]);

        //Имитация задержки ввода
        sleep(5);

        $data = [
            'username' => $this->login,
            'password' => $this->password,
            'enc_password' => $this->getEncryptedPassword(),
            'queryParams' => '{}',
            'optIntoOneTap' => false
        ];

        $loginResponse = $this->client->request('POST', 'accounts/login/ajax/', [
            'cookies' => $this->cookies,
            'headers' => [
                'x-csrftoken' => $this->getCsrfToken()
            ],
            'form_params' => $data
        ]);

        $result = json_decode($loginResponse->getBody(), true);
        if ($result['authenticated'] != true) {
            throw new InstagramLoginException('Получен отрицательный ответ при входе.');
        }

        Cache::add('cookies', $this->cookies);
    }

    /**
     * @return string
     */
    protected function getCsrfToken(): string
    {
        return $this->cookies->getCookieByName('csrftoken')->getValue();
    }

    /**
     * @return string
     */
    private function getEncryptedPassword() :string
    {
        return '#PWD_INSTAGRAM_BROWSER:0:' . time() . ':' . $this->password;
    }

    /**
     * @param string $queryHash
     * @param array $variables
     * @param bool $noRelogin
     * @return array
     * @throws InstagramLoginException
     * @throws InstagramQueryException
     */
    public function get(string $queryHash, array $variables, bool $noRelogin = false) :array
    {
        $result = $this->client->request('GET', 'graphql/query/', [
            'cookies' => $this->cookies,
            'headers' => [
                'x-csrftoken' => $this->getCsrfToken()
            ],
            'query' => [
                'query_hash' => $queryHash,
                'variables' => json_encode($variables)
            ]
        ]);
        if ($result->getStatusCode() !== 200) {
            if ($result->getStatusCode() === 500 && ! $noRelogin) {
                $this->login(true);
                return $this->get($queryHash, $variables, true);
            } else {
                throw new InstagramQueryException('Неизвестная ошибка при запросе ' .
                    $queryHash . ': ' .
                    $result->getStatusCode() . ' ' . $result->getBody()
                );
            }
        }
        return json_decode($result->getBody(), true);
    }
}
