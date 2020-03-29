<?php

namespace App\Instagram;


use App\Instagram\Interfaces\InstagramHighlights;
use Illuminate\Support\Collection;

class InstagramWebHighlights
    extends InstagramBaseWebClient
    implements InstagramHighlights
{

    /**
     * @inheritDoc
     */
    public function getHighlights(int $userId): Collection
    {
        // TODO: Implement getHighlights() method.
    }
}
