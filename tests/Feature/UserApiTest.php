<?php

namespace Tests\Feature;

use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserApiTest extends TestCase
{
    use RefreshDatabase;

    function register() {
        return $this->postJson('/api/auth/register', [
            "name" => "Fulanah",
            "email" => "fulanah@gmail.com",
            "password" => "fulanah"
        ])["token"];
    }
    
    public function test_can_register()
    {
        $data = [
            "name" => "Fulanah",
            "email" => "fulanah@gmail.com",
            "password" => "fulanah"
        ];
        $response = $this->postJson('/api/auth/register', $data);
        $response->assertStatus(200);
        $this->assertNotNull($response["token"]);
    }

    public function test_can_login()
    {
        $this->register();
        $data = [
            "email" => "fulanah@gmail.com",
            "password" => "fulanah"
        ];
        $response = $this->postJson('/api/auth/login', $data);
        $response->assertStatus(200);
        $this->assertNotNull($response["token"]);
    }

    public function get_user_detail() {
        $token = $this->register();
        $headers = [
            "Accept" => "Application/Json",
            "Authorization" => "Bearer " . $token
        ];

        $user = User::query()->orderBy("id", "desc")->first();
        $response = $this->getJson('/api/user/' . $user->id, $headers);
        $response->assertStatus(200);
    }
}
