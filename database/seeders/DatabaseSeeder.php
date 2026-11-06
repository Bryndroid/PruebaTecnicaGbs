<?php

namespace Database\Seeders;

use App\Models\Task;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        // Crear dos usuarios.
        User::factory()->create([
            'id'=> 1,
            'name' => 'Bryan Fuentes',
            'email' => 'bryan@example.com',
            'password' =>'bryanexample'
        ]);

        Task::factory()->create([
            'titulo'=> 'Estudiar ingles.',
            'descripcion'=>'Estudio diario de una hora de ingles',
            'estado' => 'EN_PROGRESO',
            'fecha_limite' => now(),
            'user_id'=> 1
        ]);
        Task::factory()->create([
            'titulo'=> 'Repasar Laravel.',
            'descripcion'=>'Conceptos basicos de Laravel. Repaso por 3 horas',
            'estado' => 'COMPLETADA',
            'fecha_limite' => now()->subDays(1),
            'user_id'=> 1
        ]);
        Task::factory()->create([
            'titulo'=> 'Completar Portafolio',
            'descripcion'=>'Terminar landing page del portafolio',
            'estado' => 'PENDIENTE',
            'fecha_limite' => now()->addDays(5),
            'user_id'=> 1
        ]);
    }
}
