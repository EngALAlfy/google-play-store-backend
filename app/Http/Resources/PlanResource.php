<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PlanResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'price' => $this->price,
            'accounts_count' => $this->accounts_count,
            'old_accounts' => $this->old_accounts,
            'photo' => $this->photo,
            'website' => $this->website,
        ];
    }
}
