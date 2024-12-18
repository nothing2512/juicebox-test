<?php

namespace Tests\Feature;

use App\Models\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PostApiTest extends TestCase
{
    use RefreshDatabase;

    function headers() {
        $token = $this->postJson('/api/auth/register', [
            "name" => "Fulanah",
            "email" => "fulanah@gmail.com",
            "password" => "fulanah"
        ])["token"];
        return [
            "Accept" => "Application/Json",
            "Authorization" => "Bearer " . $token
        ];
    }

    public function test_create_edit_delete_posts()
    {
        $headers = $this->headers();
        $data = [
            "title" => "title post",
            "content" => "content post",
            "cover" => "https://cover-post.com"
        ];

        $response = $this->postJson('/api/post', $data, $headers);
        $response->assertStatus(204);

        $post = Post::query()->orderBy("id", "desc")->first();
        $this->assertEquals($post->title, $data["title"]);

        // Get Data
        $response = $this->getJson('/api/post/' . $post->id, $headers);
        $response->assertStatus(200);
        $this->assertNotNull($response["author"]);

        // Edit Data
        $data["title"] = "new title";
        $response = $this->putJson('/api/post/' . $post->id, $data, $headers);
        $response->assertStatus(204);

        $post = Post::query()->where("id", "=", $post->id)->first();
        $this->assertEquals($post->title, $data["title"]);

        // Delete Data
        $response = $this->deleteJson('/api/post/' . $post->id, [], $headers);
        $response->assertStatus(204);

        $post = Post::query()->where("id", "=", $post->id)->first();
        $this->assertNull($post);
    }

    public function test_fetch_all_posts()
    {
        $response = $this->getJson('/api/post', $this->headers());
        $response->assertStatus(200);
    }
}
