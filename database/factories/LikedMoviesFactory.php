<?php

namespace Database\Factories;

use App\Models\LikedMovies;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class LikedMoviesFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = LikedMovies::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'movies_id' => \App\Models\Movies::factory(),
            'user_id' => \App\Models\User::factory(),
        ];
    }
}
