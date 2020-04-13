<?php


namespace App\Instagram;


use Mistersaal\Mongodb\Embed\HasEmbeddedModelsInterface;
use Mistersaal\Mongodb\Embed\HasEmbeddedModels;
use Illuminate\Support\Collection;
use Jenssegers\Mongodb\Eloquent\Model;


/**
 * Class Highlight
 * @package App\Instagram
 * @property int $id
 * @property string $title
 * @property string $preview
 * @property Collection|Story[]|array $stories
 */
class Highlight extends Model implements HasEmbeddedModelsInterface
{
    use HasEmbeddedModels;

    /** @var string */
    private $baseUrl;


    protected $fillable = [
        'id', 'title', 'preview', 'stories'
    ];
    protected $appends = [
        'link'
    ];
    public $timestamps = false;
    public $embedMany = [
        'stories' => Story::class,
    ];


    public function __construct($attributes = [])
    {
        parent::__construct($attributes);
        $this->setEmbeddedAttributes();
        $this->baseUrl = config('instagram.baseUrl') . config('instagram.highlights.url');
    }

    public function getLinkAttribute(): string
    {
        return $this->baseUrl . $this->id;
    }
}
