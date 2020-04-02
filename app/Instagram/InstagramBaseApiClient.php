<?php


namespace App\Instagram;


use Facebook\Facebook;

class InstagramBaseApiClient
{
    /** @var Facebook */
    protected $fb;
    protected $appId;
    protected $appSecret;

    /**
     * InstagramBaseApiClient constructor.
     * @param array $config
     * @throws \Facebook\Exceptions\FacebookSDKException
     */
    public function __construct(array $config = [])
    {
        $this->appId = $config['app_id'] ?? config('instagram.api.app_id');
        $this->appSecret = $config['app_secret'] ?? config('instagram.api.app_secret');
        $this->fb = new Facebook([
            'app_id' => $this->appId,
            'app_secret' => $this->appSecret,
            'default_graph_version' => $config['default_graph_version'] ?? config('instagram.api.default_graph_version')
        ]);
    }
}
