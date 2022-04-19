<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = ['user_id', 'bio', 'website', 'image'];

    use HasFactory;

    public function getProfileImage()
    {
        // If image is hosted elsewhere then just return the URL.
        if (str_starts_with($this->image, 'http')) {
            return $this->image;
        }
        // If an image exists then return it, else give the default.
        return ($this->image) ? "/storage/$this->image" : "img/defaultuser.png";
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function followers()
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }
}
