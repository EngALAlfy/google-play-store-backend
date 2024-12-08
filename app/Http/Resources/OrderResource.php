<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'buyer_id' => $this->buyer_id,
            'seller_id' => $this->seller_id,
            'account_id' => $this->account_id,
            'broker_id' => $this->broker_id,
            'total_price' => $this->total_price,
            'description' => $this->description,
            'photo' => $this->photo,
            'website' => $this->website,
            'user_id' => $this->user_id,
        ];
    }
}
