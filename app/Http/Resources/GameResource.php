<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GameResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'model' => 'Game',
            'id' => $this->id,
            'score' => $this->score,
            'is_over' => $this->is_over,
            'user' => new UserResource($this->user),
        ];
    }
}
