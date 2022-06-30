<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Movies;
use App\Models\Comment;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MoviesCommentsTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        $user = User::factory()->create(['email' => 'admin@admin.com']);

        Sanctum::actingAs($user, [], 'web');

        $this->withoutExceptionHandling();
    }

    /**
     * @test
     */
    public function it_gets_movies_comments()
    {
        $movies = Movies::factory()->create();
        $comments = Comment::factory()
            ->count(2)
            ->create([
                'movies_id' => $movies->id,
            ]);

        $response = $this->getJson(
            route('api.all-movies.comments.index', $movies)
        );

        $response->assertOk()->assertSee($comments[0]->text);
    }

    /**
     * @test
     */
    public function it_stores_the_movies_comments()
    {
        $movies = Movies::factory()->create();
        $data = Comment::factory()
            ->make([
                'movies_id' => $movies->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.all-movies.comments.store', $movies),
            $data
        );

        $this->assertDatabaseHas('comments', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $comment = Comment::latest('id')->first();

        $this->assertEquals($movies->id, $comment->movies_id);
    }
}
