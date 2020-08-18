<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;


class Post extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        return [
            'id' => $this->id,
            'body' => $this->body,
            'created_at' => $this->created_at,
            'update_at' => $this->update_at,
            'user' => $this->user,
        ];
    }
}
