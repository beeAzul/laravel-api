<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class User extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {

        //return parent::toArray($request); We don't want to retrieve the entire object
        // we want to retrieve custom fields

        return [
            'email' => $request->email,
            'name' => $request->name,
            'created_at' => $this->created_at,
        ];
    }
}
