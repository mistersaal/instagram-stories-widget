<?php


namespace App\Instagram;

use Jenssegers\Mongodb\Eloquent\Model;

/**
 * Class Story
 * @package App\Instagram
 * @property string $url
 * @property bool $isVideo
 */
class Story extends Model
{
    protected $fillable = ['url', 'isVideo'];
    public $timestamps = false;
}
