<?php


namespace App\Instagram\Interfaces;


use App\Instagram\Highlight;
use Illuminate\Support\Collection;

interface InstagramHighlights
{
    /**
     * @param int $userId
     * @return Collection|Highlight[]
     */
    function getHighlights(int $userId): Collection;
}
