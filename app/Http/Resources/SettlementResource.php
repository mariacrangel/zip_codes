<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SettlementResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'key' => $this->key, 
            'name' => strtoupper(change_character($this->name)), 
            'zone_type' => strtoupper(change_character($this->zone)),
            'settlement_type' => $this->settlement_type,
        ];
    }
    
}
