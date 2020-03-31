<?php


namespace App\Instagram;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Jsonable;
use Jenssegers\Mongodb\Eloquent\Model;

/**
 * Class Story
 * @package App\Instagram
 * @property string $url
 * @property bool $isVideo
 */
class Story extends Model implements Jsonable, Arrayable
{
    protected $fillable = ['url', 'isVideo'];
    public $timestamps = false;
}
