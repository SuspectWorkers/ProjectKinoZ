<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Movies;

use App\Models\Genres;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MoviesControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        $this->actingAs(
            User::factory()->create(['email' => 'admin@admin.com'])
        );

        $this->withoutExceptionHandling();
    }

    /**
     * @test
     */
    public function it_displays_index_view_with_all_movies()
    {
        $allMovies = Movies::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('all-movies.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.all_movies.index')
            ->assertViewHas('allMovies');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_movies()
    {
        $response = $this->get(route('all-movies.create'));

        $response->assertOk()->assertViewIs('app.all_movies.create');
    }

    /**
     * @test
     */
    public function it_stores_the_movies()
    {
        $data = Movies::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('all-movies.store'), $data);

        $this->assertDatabaseHas('movies', $data);

        $movies = Movies::latest('id')->first();

        $response->assertRedirect(route('all-movies.edit', $movies));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_movies()
    {
        $movies = Movies::factory()->create();

        $response = $this->get(route('all-movies.show', $movies));

        $response
            ->assertOk()
            ->assertViewIs('app.all_movies.show')
            ->assertViewHas('movies');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_movies()
    {
        $movies = Movies::factory()->create();

        $response = $this->get(route('all-movies.edit', $movies));

        $response
            ->assertOk()
            ->assertViewIs('app.all_movies.edit')
            ->assertViewHas('movies');
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

        $response = $this->put(route('all-movies.update', $movies), $data);

        $data['id'] = $movies->id;

        $this->assertDatabaseHas('movies', $data);

        $response->assertRedirect(route('all-movies.edit', $movies));
    }

    /**
     * @test
     */
    public function it_deletes_the_movies()
    {
        $movies = Movies::factory()->create();

        $response = $this->delete(route('all-movies.destroy', $movies));

        $response->assertRedirect(route('all-movies.index'));

        $this->assertModelMissing($movies);
    }
}
