<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Post as PostResource;


class Topic extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
//        return parent::toArray($request);
        return [
            'id' => $this->id,
            'title' => $this->title,
            'created_at' => $this->created_at,
            'update_at' => $this->update_at,
            // we get the posts related to the topic
            'posts' => PostResource::collection($this->posts), // we use collection cause more than 1 post.
            'user' => $this->user
        ];

    }
}
