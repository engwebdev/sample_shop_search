<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class Variation extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $data = [
            'id' => $this->resource->id,
            'variation_title_id' => $this->resource->variation_title_id,
            'variation_title_name' => $this->resource->variation_title_name,
            'variation_value_id' => $this->resource->variation_value_id,
            'variation_value_name' => $this->resource->variation_value_name,
            'variation_price' => $this->resource->variation_price,
        ];
        return $data;
//        return collect($data)->keyBy('id')->toArray();
        return parent::toArray($request);
    }
}
