<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Movies extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['name', 'description', 'date', 'genres_id'];

    protected $searchableFields = ['*'];

    protected $casts = [
        'date' => 'date',
    ];

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function genres()
    {
        return $this->belongsTo(Genres::class);
    }

    public function allLikedMovies()
    {
        return $this->hasMany(LikedMovies::class);
    }
}
