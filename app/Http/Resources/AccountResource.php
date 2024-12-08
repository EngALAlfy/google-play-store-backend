<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AccountResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'seller_id' => $this->seller_id,
            'creation_date' => $this->creation_date,
            'apps_count' => $this->apps_count,
            'description' => $this->description,
            'price' => $this->price,
            'photo' => $this->photo,
            'website' => $this->website,
            'user_id' => $this->user_id,
        ];
    }
}
