<?php


namespace App\Instagram;


use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Jsonable;
use Illuminate\Support\Collection;
use Jenssegers\Mongodb\Eloquent\Model;


/**
 * Class Highlight
 * @package App\Instagram
 * @property int $id
 * @property string $title
 * @property string $preview
 * @property Collection|Story[] $stories
 */
class Highlight extends Model implements Jsonable, Arrayable
{
    /** @var string */
    private $baseUrl;


    protected $fillable = [
        'id', 'title', 'preview', 'stories'
    ];
    protected $guarded = [
        'link'
    ];
    public $timestamps = false;


    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        if (is_array($this->stories) || is_null($this->stories)) {
            $this->stories = collect($this->stories)->map(function ($item) {
                return new Story($item);
            });
        }
        $this->baseUrl = config('instagram.baseUrl') . config('instagram.highlights.url');
    }

    /**
     * @return string
     */
    public function link(): ?string
    {
        return $this->baseUrl . $this->id;
    }

    /**
     * @inheritDoc
     */
    public function toArray()
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'preview' => $this->preview,
            'link' => $this->link(),
            'stories' => $this->stories->toArray()
        ];
    }
}
