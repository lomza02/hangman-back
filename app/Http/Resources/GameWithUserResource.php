<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GameWithUserResource extends JsonResource
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
            'game_time' => $this->game_time,
            'is_over' => $this->is_over,
            'user' => new UserResource($this->user),
        ];
    }
}
