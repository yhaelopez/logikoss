<?php

namespace Tests\Feature;

use App\Models\Post;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Support\Str;

use Tests\TestCase;

class PostTest extends TestCase
{
    use WithoutMiddleware, WithFaker;

    public function test_can_fetch_all_posts()
    {
        $this->withoutExceptionHandling();

        $response = $this->get(route('posts.index'));

        $response->assertViewHas('posts');
    }

    public function test_can_delete_post()
    {
        $this->withoutExceptionHandling();

        $post = Post::create([
            'slug' => $this->faker->slug(),
            'title' => $this->faker->sentence(),
            'content' => $this->faker->paragraph(),
            'remember_token' => Str::random(10),
        ]);

        $response = $this->post(route('posts.destroy', ['post' => $post]), [
            '_method' => 'DELETE',
        ]);

        $response->assertRedirect(route('posts.index'));
    }
}
