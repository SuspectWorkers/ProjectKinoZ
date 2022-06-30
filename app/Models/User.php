<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use App\Models\Scopes\Searchable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    use HasFactory;
    use Searchable;
    use HasApiTokens;

    protected $fillable = ['name', 'email', 'password', 'role'];

    protected $searchableFields = ['*'];

    protected $hidden = ['password', 'remember_token', 'role'];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function allLikedMovies()
    {
        return $this->hasMany(LikedMovies::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function isSuperAdmin()
    {
        if($this->role == 3) return true;
		else return false;
    }
	
	public function isEditor()
    {
        if($this->role >= 2) return true;
		else return false;
    }
	
	public function isUser()
    {
        if($this->role == 1) return true;
		else return false;
    }
	
}
