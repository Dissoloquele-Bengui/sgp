<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CursosResource extends JsonResource
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
            'curso'=>$this->curso,
            'duracao'=>$this->duracao,
            'descricao'=>$this->descricao,
            'vc_image'=>$this->vc_image
        ];
    }
}
