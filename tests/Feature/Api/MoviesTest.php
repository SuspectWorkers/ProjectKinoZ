<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Movies;

use App\Models\Genres;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MoviesTest extends TestCase
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
    public function it_gets_all_movies_list()
    {
        $allMovies = Movies::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.all-movies.index'));

        $response->assertOk()->assertSee($allMovies[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_movies()
    {
        $data = Movies::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.all-movies.store'), $data);

        $this->assertDatabaseHas('movies', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_movies()
    {
        $movies = Movies::factory()->create();

        $genres = Genres::factory()->create();

        $data = [
            'name' => $this->faker->name,
            'description' => $this->faker->sentence(15),
            'date' => $this->faker->date,
            'genres_id' => $genres->id,
        ];

        $response = $this->putJson(
            route('api.all-movies.update', $movies),
            $data
        );

        $data['id'] = $movies->id;

        $this->assertDatabaseHas('movies', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_movies()
    {
        $movies = Movies::factory()->create();

        $response = $this->deleteJson(route('api.all-movies.destroy', $movies));

        $this->assertModelMissing($movies);

        $response->assertNoContent();
    }
}
