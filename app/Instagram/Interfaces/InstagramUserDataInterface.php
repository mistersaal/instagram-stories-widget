<?php


namespace App\Instagram\Interfaces;


use App\Instagram\InstagramAccount;

interface InstagramUserDataInterface
{
    /**
     * @param InstagramAccount $account
     * @return string
     */
    public function getNickname(InstagramAccount $account);

    /**
     * @param InstagramAccount $account
     * @return string|null
     */
    public function getProfileImage(InstagramAccount $account);
}
