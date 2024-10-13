<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RoadMapResource extends JsonResource
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
            'courses_count' => $this->courses->count(),
            'average_rating' => $this->usersWhoRated()->avg('rating'),
            'number_of_students' => $this->enrollments()->count(),
            'courses' => $this->whenLoaded('courses'),
        ];
    }
}
