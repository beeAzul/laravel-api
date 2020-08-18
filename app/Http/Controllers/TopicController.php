<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\Topic as TopicResource;
use App\Topic;
use App\Post;

class TopicController extends Controller
{
    public function store( Request $request) {
        $topic = new Topic;
        $topic->title = $request->title;
        $topic->user()->associate($request->user()); //  se assign a user coming from the request to the topic

        $post = new Post;
        $post->body = $request->body;

        // user() refer to the user() method in the model
        $post->user()->associate($request->user()); //  se assign a user coming from the request to the posts

        $topic->save();

        // post() refer to the post() method in the model
        $topic->posts()->save($post);

        // After creation, we return the topic object into json format
        return new TopicResource($topic);

    }
}
