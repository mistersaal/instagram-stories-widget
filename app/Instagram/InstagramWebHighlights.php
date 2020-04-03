<?php

namespace App\Instagram;


use App\Exceptions\Instagram\InstagramHighlightsException;
use App\Exceptions\Instagram\InstagramLoginException;
use App\Exceptions\Instagram\InstagramQueryException;
use App\Instagram\Interfaces\InstagramHighlightsInterface;
use Illuminate\Support\Collection;

class InstagramWebHighlights
    extends InstagramBaseWebClient
    implements InstagramHighlightsInterface
{

    /**
     * @param InstagramAccount $account
     * @return Collection|Highlight[]
     * @throws InstagramHighlightsException
     * @throws InstagramLoginException
     * @throws InstagramQueryException
     */
    public function getHighlights(InstagramAccount $account): Collection
    {
        $highlights = $this->getHighlightGroups($account->userId);
        $this->setHighlightStories($highlights);

        return $highlights;
    }

    /**
     * @param int $userId
     * @return Collection|Highlight[]
     * @throws InstagramHighlightsException
     * @throws InstagramLoginException
     * @throws InstagramQueryException
     */
    private function getHighlightGroups(int $userId)
    {
        $query_hash = 'ad99dd9d3646cc3c0dda65debcd266a7';
        $response = $this->get(
            $query_hash,
            [
                "user_id" => $userId,
                "include_chaining" => true,
                "include_reel" => true,
                "include_suggested_users" => false,
                "include_logged_out_extras" => false,
                "include_highlight_reels" => true,
                "include_related_profiles" => false,
                "include_live_status" => false
            ]
        );
        $notParsedHighlights = $response['data']['user']['edge_highlight_reels']['edges'] ?? false;
        if ($notParsedHighlights === false) {
            throw new InstagramHighlightsException(
                'Отсутствуют необходимые данные в ответе сервера на getHighlightGroups: ' .
                json_encode($notParsedHighlights)
            );
        }
        return $this->parseHighlightGroupsResponse($notParsedHighlights);
    }

    /**
     * @param array $notParsedHighlights
     * @return Collection|Highlight[]
     */
    private function parseHighlightGroupsResponse(array $notParsedHighlights): Collection
    {
        $highlights = new Collection();
        foreach ($notParsedHighlights as $notParsedHighlight) {
            $notParsedHighlight = $notParsedHighlight['node'];
            $highlight = new Highlight();
            $highlight->id = $notParsedHighlight['id'];
            $highlight->title = $notParsedHighlight['title'];
            $highlight->preview = $notParsedHighlight['cover_media_cropped_thumbnail']['url'];
            $highlights->push($highlight);
        }
        return $highlights;
    }

    /**
     * @param Collection|Highlight[] $highlights
     * @throws InstagramHighlightsException
     * @throws InstagramLoginException
     * @throws InstagramQueryException
     */
    private function setHighlightStories(Collection $highlights): void
    {
        $highlightIds = $highlights->map(function ($item) {
            return (string) $item->id;
        })->toArray();
        $query_hash = 'f5dc1457da7a4d3f88762dae127e0238';
        $response = $this->get(
            $query_hash,
            [
                "reel_ids" => [],
                "tag_names" => [],
                "location_ids" => [],
                "highlight_reel_ids" => $highlightIds,
                "precomposed_overlay" => false,
                "show_story_viewer_list" => true,
                "story_viewer_fetch_count" => 50,
                "story_viewer_cursor" => "",
                "stories_video_dash_manifest" => false
            ]
        );
        $notParsedHighlightStories = $response['data']['reels_media'] ?? false;
        if ($notParsedHighlightStories === false) {
            throw new InstagramHighlightsException(
                'Отсутствуют необходимые данные в ответе сервера на setHighlightStories: ' .
                json_encode($notParsedHighlightStories)
            );
        }
        $this->parseAndSetHighlightStoriesResponse($highlights, $notParsedHighlightStories);
    }

    /**
     * @param Collection|Highlight[] $highlights
     * @param array $notParsedHighlightStories
     */
    private function parseAndSetHighlightStoriesResponse(Collection $highlights, array $notParsedHighlightStories): void
    {
        $notParsedHighlightStories = collect($notParsedHighlightStories);
        foreach ($highlights as $highlight) {
            $id = (string) $highlight->id;
            $highlightStories = $notParsedHighlightStories->firstWhere('id', $id)['items'];
            $stories = new Collection();
            foreach ($highlightStories as $highlightStory) {
                $story = new Story();
                if ($highlightStory['is_video']) {
                    $story->isVideo = true;
                    $storyUrl = collect($highlightStory['video_resources'])->last()['src'];
                } else {
                    $story->isVideo = false;
                    $storyUrl = $highlightStory['display_url'];
                }
                $story->url = $storyUrl;
                $stories->push($story);
            }
            $highlight->stories = $stories;
        }
    }
}
