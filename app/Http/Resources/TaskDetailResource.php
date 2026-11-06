<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Presenta el detalle de una tarea en la respuesta API.
 */
class TaskDetailResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'=> $this->id,
            'titulo'=> $this->titulo,
            'descripcion'=> $this->descripcion ? $this->descripcion : 'Sin descipcion',
            'estado'=>$this->estado,
            'fecha_limite'=> $this->fecha_limite
        ];
    }
}
