<?php

namespace Database\Factories;

use App\Models\Task;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Date;

/**
 * @extends Factory<Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
            'titulo'=> fake()->title('task'),
            'descripcion' => 'Default Task Factory',
            'estado' => 'PENDIENTE',
            'fecha_limite' => now()->addDays(3),
            'user_id' => 1 //Por default.
        ];
    }
}
