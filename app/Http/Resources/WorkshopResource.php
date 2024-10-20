<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class WorkshopResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'instructor_id' => $this->instructor_id,
            'instructor_name' => $this->instructor->name,
            'capacity' => $this->capacity,
            'date' => $this->date,
            'time' => $this->time,
            'price' => $this->price,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'image' => $this->image,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'number_of_users' => $this->users->count(),
            'seats_left' => $this->seatsLeft()
        ];
    }
}
