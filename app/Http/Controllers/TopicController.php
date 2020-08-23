<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\Topic as TopicResource;
use App\Http\Requests\TopicCreateRequest; // For validation
use App\Topic;
use App\Post;

class TopicController extends Controller
{
    public function store( TopicCreateRequest $request) {
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

    public function index(Request $request)
    {
        // Now se can use latestFirst method cause we use it in the Topic model
        $topics = Topic::latestFirst()->paginate(5);

        // we don't use "new TopicResource" because we return many topics
        return TopicResource::collection($topics);
    }

    public function show(Topic $topic) {
        return new TopicResource($topic);
    }
}
