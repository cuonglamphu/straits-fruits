<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class InvoiceResource extends JsonResource
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
            'Customer_Name' => $this->Customer_Name,
            'Total' => $this->Total,
            'created_at' => $this->create_at,
            'update_at' => $this->update_at
        ];
    }
}
