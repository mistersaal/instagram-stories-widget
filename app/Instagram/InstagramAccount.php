<?php


namespace App\Instagram;


use Jenssegers\Mongodb\Eloquent\Model;

/**
 * Class InstagramAccount
 * @package App\Instagram
 * @property int $userId
 */
class InstagramAccount extends Model
{
    public $timestamps = false;
    protected $fillable = ['userId'];
}
