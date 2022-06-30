<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\LikedMovies;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserAllLikedMoviesTest extends TestCase
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
    public function it_gets_user_all_liked_movies()
    {
        $user = User::factory()->create();
        $allLikedMovies = LikedMovies::factory()
            ->count(2)
            ->create([
                'user_id' => $user->id,
            ]);

        $response = $this->getJson(
            route('api.users.all-liked-movies.index', $user)
        );

        $response->assertOk()->assertSee($allLikedMovies[0]->id);
    }

    /**
     * @test
     */
    public function it_stores_the_user_all_liked_movies()
    {
        $user = User::factory()->create();
        $data = LikedMovies::factory()
            ->make([
                'user_id' => $user->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.users.all-liked-movies.store', $user),
            $data
        );

        $this->assertDatabaseHas('liked_movies', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $likedMovies = LikedMovies::latest('id')->first();

        $this->assertEquals($user->id, $likedMovies->user_id);
    }
}
