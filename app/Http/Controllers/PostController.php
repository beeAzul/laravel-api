<?php

namespace App\Http\Controllers;

use App\Http\Resources\Post as PostResource;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Post;
use App\Topic;

class PostController extends Controller
{


    public function show(Topic $topic, Post $post)
    {
        return new PostResource($post);
    }


    public function store(StorePostRequest $request, Topic $topic)
    {
        $post = new Post;
        $post->body = $request->body;
        $post->user()->associate($request->user());
        // we save the post of the topic
        $topic->posts()->save($post);

        return new PostResource($post);
    }


    /**
     * Note : Cause we use nested route group, we have to define Topic in parameter, Post always depends on Topic and belongs to a Topic.
    When we try to PATCH to '/api/topics/1/posts/22, Laravel try to get Topic with id 1 and Post with id 22 from db and
    inject it in update params function (below), the entire objects models Topic and Post
     * @param UpdatePostRequest $request
     * @param Topic $topic
     * @param Post $post
     * @return PostResource
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(UpdatePostRequest $request, Topic $topic, Post $post)
    {
        // Refer to App/Policies/PostPolicy::update()
        $this->authorize('update', $post);
        $post->body = $request->get('body', $post->body);
        $post->user()->associate($request->user());
        $post->save();

        return new PostResource($post);
    }

    public function destroy(Topic $topic, Post $post)
    {
        // Refer to App/Policies/PostPolicy::destroy()
        $this->authorize('destroy', $post);
        $post->delete();
        return response(null, 204);
    }
}
