<?php

namespace App\Models;

use App\Contracts\Likeable;
use App\Models\Concerns\Likes;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model implements Likeable
{
    protected $fillable = ['caption'];

    use Likes;
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
