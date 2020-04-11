<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

class InstagramDataTest extends TestCase
{
    use WithoutMiddleware;

    public function testUpdatingInstagramData()
    {
        auth()->login(\App\User::first());
        $response = $this->patch(route('instagram.data.update'));
        $response->assertStatus(200);
    }
}
