<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\LikedMovies;

use App\Models\Movies;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LikedMoviesControllerTest extends TestCase
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
    public function it_displays_index_view_with_all_liked_movies()
    {
        $allLikedMovies = LikedMovies::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('all-liked-movies.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.all_liked_movies.index')
            ->assertViewHas('allLikedMovies');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_liked_movies()
    {
        $response = $this->get(route('all-liked-movies.create'));

        $response->assertOk()->assertViewIs('app.all_liked_movies.create');
    }

    /**
     * @test
     */
    public function it_stores_the_liked_movies()
    {
        $data = LikedMovies::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('all-liked-movies.store'), $data);

        $this->assertDatabaseHas('liked_movies', $data);

        $likedMovies = LikedMovies::latest('id')->first();

        $response->assertRedirect(route('all-liked-movies.edit', $likedMovies));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_liked_movies()
    {
        $likedMovies = LikedMovies::factory()->create();

        $response = $this->get(route('all-liked-movies.show', $likedMovies));

        $response
            ->assertOk()
            ->assertViewIs('app.all_liked_movies.show')
            ->assertViewHas('likedMovies');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_liked_movies()
    {
        $likedMovies = LikedMovies::factory()->create();

        $response = $this->get(route('all-liked-movies.edit', $likedMovies));

        $response
            ->assertOk()
            ->assertViewIs('app.all_liked_movies.edit')
            ->assertViewHas('likedMovies');
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

        $response = $this->put(
            route('all-liked-movies.update', $likedMovies),
            $data
        );

        $data['id'] = $likedMovies->id;

        $this->assertDatabaseHas('liked_movies', $data);

        $response->assertRedirect(route('all-liked-movies.edit', $likedMovies));
    }

    /**
     * @test
     */
    public function it_deletes_the_liked_movies()
    {
        $likedMovies = LikedMovies::factory()->create();

        $response = $this->delete(
            route('all-liked-movies.destroy', $likedMovies)
        );

        $response->assertRedirect(route('all-liked-movies.index'));

        $this->assertModelMissing($likedMovies);
    }
}
