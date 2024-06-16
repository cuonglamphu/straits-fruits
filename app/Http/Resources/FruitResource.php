<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FruitResource extends JsonResource
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
            'Fruit_Name' => $this->name,
            'Price' => $this->price,
            'Category_ID' => $this->Category_ID,
            'Unit_ID' => $this->Unit_ID,
            'Created_at' => $this->created_at,
            'Updated_at' => $this->updated_at,
        ];
    }
}
