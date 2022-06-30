<?php

namespace Database\Seeders;

use App\Models\LikedMovies;
use Illuminate\Database\Seeder;

class LikedMoviesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        LikedMovies::factory()
            ->count(5)
            ->create();
    }
}
