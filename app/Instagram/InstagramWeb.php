<?php

namespace App\Instagram;


use App\Exceptions\Instagram\InstagramLoginException;
use GuzzleHttp\Client;
use GuzzleHttp\Cookie\CookieJar;
use Illuminate\Support\Facades\Cache;

class InstagramWeb
{
    private $login;
    private $password;
    private $userAgent;
    protected $baseUrl;

    private $encryptionKeyUrl;

    /** @var CookieJar */
    protected $cookies;
    /** @var Client */
    protected $client;

    /**
     * InstagramWeb constructor.
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
        $this->encryptionKeyUrl = config('instagram.encryptionKeyUrl'); //TODO: убрать это поле, если больше не нужно
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
     * @throws InstagramLoginException
     */
    protected function login()
    {
        if (Cache::has('cookies')) {
            $this->cookies = Cache::get('cookies');
            return;
        }

        $this->cookies = new CookieJar();
        $this->client->request('GET', '/', [
            'cookies' => $this->cookies
        ]);
        $csrf = $this->getCsrfToken();

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
                'x-csrftoken' => $csrf
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
}
