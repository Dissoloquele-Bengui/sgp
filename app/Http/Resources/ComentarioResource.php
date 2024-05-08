<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ComentarioResource extends JsonResource
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
            'txt_comment' => $this->txt_comment,
            'it_id_curso' => $this->it_id_curso,
            'it_id_user' => $this->it_id_user,
            'it_id_aula' => $this->it_id_aula,

        ];
    }
}
