<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id'=> $this->id,
            'title'=> $this->title,
            'created'=> $this->created_at->diffForHumans(),
            'topics'=> TopicResource::collection($this->topics),
            'profile'=> new ProfileResource($this->profile),
            'images'=> $this->images
        ];
    }
}
