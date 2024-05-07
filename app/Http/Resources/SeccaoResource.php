<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SeccaoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return parent::toArray($request);
        return [
            'id' =>$this->id,
            'vc_title' => $this->vc_title,
            'txt_description' => $this->txt_description,
            'it_number' => $this->it_number,
            'it_id_curso' => $this->it_id_curso,
        ];
    }
}
