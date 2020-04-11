<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Cache;
use Tests\TestCase;

class WidgetTest extends TestCase
{
    public function testWidgetData()
    {
        $hash = \App\User::first()->_id;
        Cache::forget($hash);
        $response = $this->get(route('instagram.widget.data') . '?hash=' . $hash);
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'highlights',
            'stories',
            'userData' => [
                'nickname',
                'image'
            ]
        ]);
    }
}
