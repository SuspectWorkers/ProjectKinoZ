<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LikedMovies extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['movies_id', 'user_id'];

    protected $searchableFields = ['*'];

    protected $table = 'liked_movies';

    public function movies()
    {
        return $this->belongsTo(Movies::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
