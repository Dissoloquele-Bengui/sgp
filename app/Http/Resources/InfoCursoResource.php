<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoriaInfoResource extends JsonResource
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
            'txt_text' => $this->txt_text,
            'it_id_curso' => $this->it_id_curso,
            'it_id_categoriaCurso' => $this->it_id_categoriaCurso,

        ];
    }
}
