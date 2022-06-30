<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Genres;
use App\Models\Movies;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class GenresAllMoviesTest extends TestCase
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
    public function it_gets_genres_all_movies()
    {
        $genres = Genres::factory()->create();
        $allMovies = Movies::factory()
            ->count(2)
            ->create([
                'genres_id' => $genres->id,
            ]);

        $response = $this->getJson(
            route('api.all-genres.all-movies.index', $genres)
        );

        $response->assertOk()->assertSee($allMovies[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_genres_all_movies()
    {
        $genres = Genres::factory()->create();
        $data = Movies::factory()
            ->make([
                'genres_id' => $genres->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.all-genres.all-movies.store', $genres),
            $data
        );

        $this->assertDatabaseHas('movies', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $movies = Movies::latest('id')->first();

        $this->assertEquals($genres->id, $movies->genres_id);
    }
}
