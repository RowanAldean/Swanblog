<?php

namespace App\Models;

use App\Contracts\Likeable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'is_bot',
        'name',
        'email',
        'username',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function profile()
    {
        return $this->hasOne(Profile::class);
    }

    public function following()
    {
        return $this->belongsToMany(Profile::class)->withTimestamps();
    }

    public function posts()
    {
        return $this->hasMany(Post::class)->orderBy('created_at', 'DESC');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function like(Likeable $likeable): self
    {
        //If the user has already liked then we don't care
        if ($this->hasLiked($likeable)) {
            return $this;
        }

        /*Else create a new Like instance and associate it with this user and the likeable
          object - a Post.*/
        (new Like())
            ->user()->associate($this)
            ->likeable()->associate($likeable)
            ->save();

        return $this;
    }

    public function unlike(Likeable $likeable): self
    {
        //If user hasnt liked it then just return
        if (!$this->hasLiked($likeable)) {
            return $this;
        }

        //Otherwise remove the like using the delete() method
        $likeable->likes()
            ->whereHas('user', function ($query) {
                return $query->whereId($this->id);
            })
            ->delete();

        return $this;
    }

    public function hasLiked(Likeable $likeable): bool
    {
        //If the likeable model doesn't exist (Post) then return false (can't have liked)
        if (!$likeable->exists) {
            return false;
        }

        //Otherwise return whether or not this user_id has liked the likeable item
        return $likeable->likes()
            ->whereHas('user', function ($query) {
                return $query->whereId($this->id);
            })
            ->exists();
    }

    public function isAdmin(): bool
    {
        return ($this->admin);
    }
}
