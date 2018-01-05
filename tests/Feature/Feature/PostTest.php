<?php

namespace Tests\Feature;

use App\Post;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

class PostTest extends TestCase {
    public function testsPostsAreCreatedCorrectly() {
        $user = factory(User::class)->create();
        $token = $user->generateToken();
        $headers = ['Authorization' => "Bearer $token"];
        $payload = [
            'title' => 'Lorem',
            'body' => 'Ipsum',
        ];

        $this->json('POST', '/api/posts', $payload, $headers)
            ->assertStatus(200)
            ->assertJson(['id' => 1, 'title' => 'Lorem', 'body' => 'Ipsum']);
    }

    public function testsPostsAreUpdatedCorrectly() {
        $user = factory(User::class)->create();
        $token = $user->generateToken();
        $headers = ['Authorization' => "Bearer $token"];
        $post = factory(Post::class)->create([
            'title' => 'First Post',
            'body' => 'First Body',
        ]);

        $payload = [
            'title' => 'Lorem',
            'body' => 'Ipsum',
        ];

        $response = $this->json('PUT', '/api/posts/' . $post->id, $payload, $headers)
            ->assertStatus(200)
            ->assertJson(['id' => 1, 'title' => 'Lorem', 'body' => 'Ipsum']);
    }

    public function testsPostsAreDeletedCorrectly() {
        $user = factory(User::class)->create();
        $token = $user->generateToken();
        $headers = ['Authorization' => "Bearer $token"];
        $post = factory(Post::class)->create([
            'title' => 'First Post',
            'body' => 'First Body',
        ]);

        $this->json('DELETE', '/api/posts/' . $post->id, [], $headers)
            ->assertStatus(204);
    }

    public function testPostsAreListedCorrectly() {
        factory(Post::class)->create([
            'title' => 'First Post',
            'body' => 'First Body',
        ]);

        factory(Post::class)->create([
            'title' => 'Second Post',
            'body' => 'Second Body',
        ]);

        $user = factory(User::class)->create();
        $token = $user->generateToken();
        $headers = ['Authorization' => "Bearer $token"];

        $response = $this->json('GET', '/api/posts', [], $headers)
            ->assertStatus(200)
            ->assertJson([
                ['title' => 'First Post', 'body' => 'First Body'],
                ['title' => 'Second Post', 'body' => 'Second Body'],
            ])
            ->assertJsonStructure([
                '*' => ['id', 'body', 'title', 'created_at', 'updated_at'],
            ]);
    }

    public function testUserCantAccessPostsWithWrongToken() {
        factory(Post::class)->create();
        $user = factory(User::class)->create(['email' => 'user@test.com']);
        $token = $user->generateToken();
        $headers = ['Authorization' => "Bearer $token"];
        $user->generateToken();

        $this->json('get', '/api/posts', [], $headers)->assertStatus(401);
    }

    public function testUserCantAccessPostsWithoutToken() {
        factory(Post::class)->create();

        $this->json('get', '/api/posts')->assertStatus(401);
    }
}
