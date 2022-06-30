<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Movies;
use App\Models\LikedMovies;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MoviesAllLikedMoviesTest extends TestCase
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
    public function it_gets_movies_all_liked_movies()
    {
        $movies = Movies::factory()->create();
        $allLikedMovies = LikedMovies::factory()
            ->count(2)
            ->create([
                'movies_id' => $movies->id,
            ]);

        $response = $this->getJson(
            route('api.all-movies.all-liked-movies.index', $movies)
        );

        $response->assertOk()->assertSee($allLikedMovies[0]->id);
    }

    /**
     * @test
     */
    public function it_stores_the_movies_all_liked_movies()
    {
        $movies = Movies::factory()->create();
        $data = LikedMovies::factory()
            ->make([
                'movies_id' => $movies->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.all-movies.all-liked-movies.store', $movies),
            $data
        );

        $this->assertDatabaseHas('liked_movies', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $likedMovies = LikedMovies::latest('id')->first();

        $this->assertEquals($movies->id, $likedMovies->movies_id);
    }
}
