<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    use RefreshDatabase;
    
    public function test_example()
    {
        /** @var User */
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get('/');

        $response->assertStatus(200);
    }
}
