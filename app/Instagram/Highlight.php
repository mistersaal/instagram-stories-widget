<?php


namespace App\Instagram;


use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Jsonable;
use Illuminate\Support\Collection;

class Highlight implements Jsonable, Arrayable
{
    /** @var int */
    private $id;
    /** @var string */
    private $title;
    /** @var string */
    private $preview;
    /** @var Collection|Story[] */
    private $stories;
    /** @var string */
    private $baseUrl;

    public function __construct()
    {
        $this->baseUrl = config('instagram.baseUrl') . config('instagram.highlights.url');
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getPreview(): string
    {
        return $this->preview;
    }

    /**
     * @param string $preview
     */
    public function setPreview(string $preview): void
    {
        $this->preview = $preview;
    }

    /**
     * @return Collection|Story[]
     */
    public function getStories(): Collection
    {
        return $this->stories;
    }

    /**
     * @param Collection|Story[] $stories
     */
    public function setStories(Collection $stories): void
    {
        $this->stories = $stories;
    }

    /**
     * @return string
     */
    public function getLink(): string
    {
        return $this->baseUrl . $this->id;
    }

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
            'id' => $this->getId(),
            'title' => $this->getTitle(),
            'preview' => $this->getPreview(),
            'link' => $this->getLink(),
            'stories' => $this->getStories()->toArray()
        ];
    }
}
