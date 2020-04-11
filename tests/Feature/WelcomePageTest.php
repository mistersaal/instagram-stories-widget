<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class WelcomePageTest extends TestCase
{
    public function testWelcomePage()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
