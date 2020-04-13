<?php

namespace App;

use App\Instagram\Highlight;
use App\Instagram\InstagramAccount;
use Illuminate\Auth\MustVerifyEmail;
use Illuminate\Contracts\Auth\MustVerifyEmail as MustVerifyEmailContract;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Collection;
use Jenssegers\Mongodb\Eloquent\Model;
use Illuminate\Auth\Authenticatable as Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Mistersaal\Mongodb\Embed\HasEmbeddedModelsInterface;
use Mistersaal\Mongodb\Embed\HasEmbeddedModels;

/**
 * Class User
 * @package App
 * @property Collection|Highlight[]|array $highlights
 * @property InstagramAccount|array $instagramAccount
 */
class User extends Model
    implements AuthenticatableContract, CanResetPasswordContract, MustVerifyEmailContract, HasEmbeddedModelsInterface
{
    use Authenticatable;
    use Notifiable;
    use CanResetPassword;
    use MustVerifyEmail;
    use HasEmbeddedModels;


    protected $connection = 'mongodb';

    public function __construct($attributes = []) {
        parent::__construct($attributes);
        $this->setEmbeddedAttributes();
    }

    protected $fillable = [
        'name', 'email', 'password', 'highlights', 'instagramAccount'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $embedMany = [
        'highlights' => Highlight::class,
    ];
    protected $embedOne = [
        'instagramAccount' => InstagramAccount::class,
    ];

}
