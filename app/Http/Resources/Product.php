<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class Product extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
//        dd(4,$this->resource);
        $data = [
            'id' => $this->resource->id,
            'title' => $this->resource->title,
            'description' => $this->resource->description,
            'price' => $this->resource->price,
        ];
        if ($this->resource->relationLoaded('variations')) {
//            dd(collect(($this->resource->variations)->keyBy('id')));
            $variations = Variation::collection($this->resource->variations)->resolve();
//            $variations = ;
            $data['variations'] = $variations;

        }
//        dd($data, 2);
        return $data;
//        return parent::toArray($request);
    }
}
