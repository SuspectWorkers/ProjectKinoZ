<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Comment extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['text', 'movies_id', 'user_id'];

    protected $searchableFields = ['*'];

    public function movies()
    {
        return $this->belongsTo(Movies::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
