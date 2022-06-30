<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Genres;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class GenresTest extends TestCase
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
    public function it_gets_all_genres_list()
    {
        $allGenres = Genres::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.all-genres.index'));

        $response->assertOk()->assertSee($allGenres[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_genres()
    {
        $data = Genres::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.all-genres.store'), $data);

        $this->assertDatabaseHas('genres', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
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

        $response = $this->putJson(
            route('api.all-genres.update', $genres),
            $data
        );

        $data['id'] = $genres->id;

        $this->assertDatabaseHas('genres', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_genres()
    {
        $genres = Genres::factory()->create();

        $response = $this->deleteJson(route('api.all-genres.destroy', $genres));

        $this->assertModelMissing($genres);

        $response->assertNoContent();
    }
}
