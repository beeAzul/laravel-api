<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    protected $fillable = ['title'];

    // A topics belong to a User
    public function user() {
        return $this->belongsTo(User::class);
    }

    // A Topics can have many Posts
    public function post() {
        return $this->hasMany(Posts::class);
    }
}
