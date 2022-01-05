<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class ModuleResource extends JsonResource
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
            'identify' => $this->uuid,
            'title' => $this->name,
            'date' => Carbon::make($this->created_at)->format('Y-m-d'),
            'lessons' => LessonResource::collection($this->whenLoaded('lessons'))
        ];
    }
}
