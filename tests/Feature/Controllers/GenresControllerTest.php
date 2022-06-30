<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Genres;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class GenresControllerTest extends TestCase
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
    public function it_displays_index_view_with_all_genres()
    {
        $allGenres = Genres::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('all-genres.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.all_genres.index')
            ->assertViewHas('allGenres');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_genres()
    {
        $response = $this->get(route('all-genres.create'));

        $response->assertOk()->assertViewIs('app.all_genres.create');
    }

    /**
     * @test
     */
    public function it_stores_the_genres()
    {
        $data = Genres::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('all-genres.store'), $data);

        $this->assertDatabaseHas('genres', $data);

        $genres = Genres::latest('id')->first();

        $response->assertRedirect(route('all-genres.edit', $genres));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_genres()
    {
        $genres = Genres::factory()->create();

        $response = $this->get(route('all-genres.show', $genres));

        $response
            ->assertOk()
            ->assertViewIs('app.all_genres.show')
            ->assertViewHas('genres');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_genres()
    {
        $genres = Genres::factory()->create();

        $response = $this->get(route('all-genres.edit', $genres));

        $response
            ->assertOk()
            ->assertViewIs('app.all_genres.edit')
            ->assertViewHas('genres');
    }

    /**
     * @test
     */
    public function it_updates_the_genres()
    {
        $genres = Genres::factory()->create();

        $data = [
            'name' => $this->faker->name,
        ];

        $response = $this->put(route('all-genres.update', $genres), $data);

        $data['id'] = $genres->id;

        $this->assertDatabaseHas('genres', $data);

        $response->assertRedirect(route('all-genres.edit', $genres));
    }

    /**
     * @test
     */
    public function it_deletes_the_genres()
    {
        $genres = Genres::factory()->create();

        $response = $this->delete(route('all-genres.destroy', $genres));

        $response->assertRedirect(route('all-genres.index'));

        $this->assertModelMissing($genres);
    }
}
