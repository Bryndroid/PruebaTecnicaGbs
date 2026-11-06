<?php

use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use App\Models\User;
use Illuminate\Support\Facades\Route;

// Autenticación pública.
Route::post("/login", [UserController::class, 'login']); // Iniciar sesión.
Route::post("/register", [UserController::class, 'register']); // Registrar usuario.

// Operaciones protegidas con token.
Route::middleware('auth:sanctum')->group(function (){
    // Cerrar la sesión del usuario.
    Route::get("/logout", [UserController::class, 'logout']);
    Route::get("/tareas",[TaskController::class, "index"]); // Listar tareas del usuario.
    Route::post("/tareas",[TaskController::class, "create"]); // Crear una tarea.
    Route::get("/tareas/{id}",[TaskController::class, "details"]); // Consultar una tarea.
    Route::put("/tareas/{id}",[TaskController::class, "update"]); // Actualizar una tarea.
    Route::delete("/tareas/{id}",[TaskController::class, "delete"]); // Eliminar una tarea.

});
