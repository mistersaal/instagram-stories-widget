<?php


namespace App\Instagram\Interfaces;


use App\Instagram\Highlight;
use App\Instagram\InstagramAccount;
use Illuminate\Support\Collection;

interface InstagramHighlightsInterface
{
    /**
     * @param InstagramAccount $account
     * @return Collection|Highlight[]
     */
    function getHighlights(InstagramAccount $account): Collection;
}
