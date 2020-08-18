<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['body'];

    // A Post belong to a User
    public function user() {
        return $this->belongsTo(User::class);
    }

    // A Posts belong to a Topic
    public function topic() {
        return $this->belongsTo(Topic::class);
    }
}
