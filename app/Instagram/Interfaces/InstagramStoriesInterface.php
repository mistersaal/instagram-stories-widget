<?php


namespace App\Instagram\Interfaces;


use App\Instagram\InstagramAccount;
use App\Instagram\Story;
use Illuminate\Support\Collection;

interface InstagramStoriesInterface
{
    /**
     * @param InstagramAccount $account
     * @return Collection|Story[]
     */
    public function getStories(InstagramAccount $account);
}
