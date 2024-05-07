<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AnexoResource extends JsonResource
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
            'vc_thumb' => $file['url_absoluta'],
            'it_id_seccao' => $this->it_id_seccao,
            'it_id_curso' => $this->it_id_curso,
        ];
    }
}
