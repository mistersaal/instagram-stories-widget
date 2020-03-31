<?php

namespace App;

use App\Instagram\Highlight;
use App\Instagram\InstagramAccount;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Collection;
use Jenssegers\Mongodb\Eloquent\Model;
use Illuminate\Auth\Authenticatable as Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

/**
 * Class User
 * @package App
 * @property Collection|Highlight[]|array $highlights
 * @property InstagramAccount|array $instagramAccount
 */
class User extends Model implements AuthenticatableContract, CanResetPasswordContract
{
    use Authenticatable;
    use Notifiable;
    use CanResetPassword;


    protected $connection = 'mongodb';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'highlights', 'instagramAccount'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Cast highlights to collection of objects
     */
    protected static function boot()
    {
        parent::boot();
        static::retrieved(function (User $user) {
            $user->highlights = collect($user->highlights)->map(function ($item) {
                return new Highlight($item);
            });
            if ($user->instagramAccount) {
                $user->instagramAccount = new InstagramAccount($user->instagramAccount);
            }
        });
        static::saving(function (User $user) {
            $user->highlights = $user->highlights->toArray();
            if ($user->instagramAccount) {
                $user->instagramAccount = $user->instagramAccount->toArray();
            }
        });
    }
}
