<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Valida los datos para crear o actualizar una tarea.
 */
class TaskCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $required = $this->isMethod('POST') ? 'required' : 'sometimes';

        return [
            'titulo' => [$required, 'string', 'max:50'],
            'descripcion' => ['sometimes', 'nullable', 'string'],
            'estado' => [$required, 'in:PENDIENTE,EN_PROGRESO,COMPLETADA'],
            'fecha_limite' => [$required, 'date'],
        ];
    }
}
