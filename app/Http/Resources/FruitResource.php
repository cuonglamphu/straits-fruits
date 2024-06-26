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
            'Fruit_Name' => $this->Fruit_Name,
            'Price' => $this->Price,
            'Category_ID' => $this->category_id,
            'Unit_ID' => $this->unit_id,
            'Created_at' => $this->created_at,
            'Updated_at' => $this->updated_at,
        ];
    }
}
