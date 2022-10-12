<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Post;
use Database\Seeders\PostTableSeeder;

class DatabaseTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test if models can be instantiated
     *
     * @return void
     */
    public function test_models_can_be_instantiated()
    {
        Post::factory()->create();
        $this->assertDatabaseCount('posts', 1);
    }

    /**
     * Test creating a new post
     *
     * @return void
     */
    public function test_posts_can_be_created()
    {
        $this->seed(PostTableSeeder::class);
        $this->assertDatabaseCount('posts', 30);
    }
}
