<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TicketResource extends JsonResource
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
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'status' => $this->status,
            'priority' => $this->priority,
            'type' => new TicketTypeResource($this->type),
            'owner' => new UserResource($this->user),
            'assignee' => new UserResource($this->assignee),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
