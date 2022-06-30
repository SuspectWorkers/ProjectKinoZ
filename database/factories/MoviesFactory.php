<?php

namespace Database\Factories;

use App\Models\Movies;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class MoviesFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Movies::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'description' => $this->faker->sentence(15),
            'date' => $this->faker->date,
            'genres_id' => \App\Models\Genres::factory(),
        ];
    }
}
