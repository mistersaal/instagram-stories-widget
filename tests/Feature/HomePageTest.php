<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class HomePageTest extends TestCase
{
    public function testPageInaccessibilityToGuestUser()
    {
        auth()->logout();

        $response = $this->get(route('home'));
        $response->assertStatus(302);
    }

    public function testPageAccessToUser()
    {
        auth()->login(\App\User::first());

        $response = $this->get(route('home'));
        $response->assertStatus(200);
    }
}
