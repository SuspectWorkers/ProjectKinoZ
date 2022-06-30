<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\LikedMovies;

use App\Models\Movies;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LikedMoviesTest extends TestCase
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
    public function it_gets_all_liked_movies_list()
    {
        $allLikedMovies = LikedMovies::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.all-liked-movies.index'));

        $response->assertOk()->assertSee($allLikedMovies[0]->id);
    }

    /**
     * @test
     */
    public function it_stores_the_liked_movies()
    {
        $data = LikedMovies::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.all-liked-movies.store'), $data);

        $this->assertDatabaseHas('liked_movies', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_liked_movies()
    {
        $likedMovies = LikedMovies::factory()->create();

        $movies = Movies::factory()->create();
        $user = User::factory()->create();

        $data = [
            'movies_id' => $movies->id,
            'user_id' => $user->id,
        ];

        $response = $this->putJson(
            route('api.all-liked-movies.update', $likedMovies),
            $data
        );

        $data['id'] = $likedMovies->id;

        $this->assertDatabaseHas('liked_movies', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_liked_movies()
    {
        $likedMovies = LikedMovies::factory()->create();

        $response = $this->deleteJson(
            route('api.all-liked-movies.destroy', $likedMovies)
        );

        $this->assertModelMissing($likedMovies);

        $response->assertNoContent();
    }
}
