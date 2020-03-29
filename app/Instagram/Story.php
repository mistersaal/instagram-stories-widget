<?php


namespace App\Instagram;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Jsonable;

class Story implements Jsonable, Arrayable
{
    /** @var string */
    private $url;

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * @param string $url
     */
    public function setUrl(string $url): void
    {
        $this->url = $url;
    }

    /**
     * @inheritDoc
     */
    public function toJson($options = 0)
    {
        return json_encode($this->toArray(), $options);
    }

    /**
     * @inheritDoc
     */
    public function toArray()
    {
        return [
            'url' => $this->getUrl()
        ];
    }
}
