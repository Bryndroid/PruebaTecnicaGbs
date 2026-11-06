<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        //
        Schema::create('tasks', function (Blueprint $table){
            $table->id();
            $table->string('titulo', 50);   
            $table->text('descripcion')->nullable();
            $table->enum('estado',['PENDIENTE','EN_PROGRESO','COMPLETADA']);
            $table->date('fecha_limite');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->timestamps();        
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('tasks');
    }
};
