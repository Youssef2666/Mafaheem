<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CourseResource extends JsonResource
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
            'raters' => $this->ratings,
            'average_rating' => $this->ratings()->avg('rating'),
            'number_of_ratings' => $this->ratings->count(),
            'instructor_name' => $this->instructor->name,        
            'instructor_id' => $this->instructor->id,        
            'enrollment_count' => $this->enrollments->count(),
            'title' => $this->title,
            'description' => $this->description,
            'image' => $this->image,
            'price' => $this->price,
            'level' => $this->level,
            'duration' => $this->duration,
            'category' => CategoryResource::collection($this->whenLoaded('categories')),
            'subscriptionPlan' => $this->whenLoaded('subscriptionPlan'),
            'lessons' => LessonResource::collection($this->whenLoaded('lessons')),
            'reviews' => $this->whenLoaded('reviews'),
        ];
    }
}
