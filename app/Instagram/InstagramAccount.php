<?php


namespace App\Instagram;


use Facebook\Facebook;
use Jenssegers\Mongodb\Eloquent\Model;

/**
 * Class InstagramAccount
 * @package App\Instagram
 * @property int $userId
 * @property int $businessId
 * @property string $accessToken
 * @property string $nickname
 * @property string $image
 */
class InstagramAccount extends Model
{
    public $timestamps = false;
    protected $fillable = ['userId', 'businessId', 'accessToken', 'nickname', 'image'];
}
