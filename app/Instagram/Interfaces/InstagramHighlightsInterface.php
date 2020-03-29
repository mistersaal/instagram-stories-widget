<?php


namespace App\Instagram\Interfaces;


use App\Instagram\Highlight;
use Illuminate\Support\Collection;

interface InstagramHighlightsInterface
{
    /**
     * @param int $userId
     * @return Collection|Highlight[]
     */
    function getHighlights(int $userId): Collection;
}
