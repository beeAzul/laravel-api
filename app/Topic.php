<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Orderable;

class Topic extends Model
{
    use Orderable;
    protected $fillable = ['title'];

    // A topics belong to a User
    public function user() {
        return $this->belongsTo(User::class);
    }

    // A Topics can have many Posts
    public function posts() {
        return $this->hasMany(Post::class);
    }
}
