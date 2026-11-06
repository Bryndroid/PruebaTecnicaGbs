<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskCreateRequest;
use App\Http\Resources\TaskDetailResource;
use App\Http\Resources\TaskResource;
use Illuminate\Http\Request;

/**
 * Gestiona las operaciones de tareas del usuario autenticado.
 */
class TaskController extends Controller{

    /**
     * Devuelve las tareas del usuario autenticado.
     */
    public function index(Request $request){

        $response = [
            'status' => 'error',
            'message'=>'Error_Default',
            'data' => null,
            'error'=> false
        ];
        $tasks = $request->user()->tasks()->latest()->get();

        $response['message'] = "Tareas retornadas con exito";
        $response['status'] = 'exito';
        $response['data']= TaskResource::collection($tasks);
        return response()->json($response, 200);
    }

    /**
     * Crea una tarea para el usuario autenticado.
     */
    public function create(TaskCreateRequest $request){

        $response = [
            'status' => 'error',
            'message'=>'Error_Default',
            'data' => null,
            'error'=> false
        ];
        $task = $request->user()->tasks()->create($request->validated());

        $response['message'] = "Tareas retornadas con exito";
        $response['status'] = 'exito';
        $response['data']= new TaskDetailResource($task);
        return response()->json($response, 201);
    }

    /**
     * Devuelve el detalle de una tarea del usuario.
     */
    public function details(Request $request, int $id){
        $task = $request->user()->tasks()->findOrFail($id);
       

        $response = [
            'status' => 'exito',
            'message'=>'Detalle de la tarea con Id: ' . $id,
            'data' => new TaskDetailResource($task),
            'error'=> false
        ];

      

        return response()->json($response, 200);
    }

    /**
     * Actualiza una tarea del usuario autenticado.
     */
    public function update(TaskCreateRequest $request, int $id){

        $task = $request->user()->tasks()->findOrFail($id);
        $task->update($request->validated());
        $response = [
            'status' => 'exito',
            'message'=>'Detalle de la tarea con Id: ' . $id . ' actualizado',
            'data' =>  $request->validated(),
            'error'=> false
        ];
       

        return response()->json($response, 200);
    }

    /**
     * Elimina una tarea del usuario autenticado.
     */
    public function delete(Request $request, int $id){
        $task = $request->user()->tasks()->find($id);
        if(!$task){
            return response()->json(['message'=>'Recurso no existente'],404);
        }
        $task->delete();
        $response = [
            'status' => 'exito',
            'message'=>'Borrado con exito la tarea con Id: ' . $id ,
            'data' =>  null,
            'error'=> false
        ];
        return response()->json($response, 200);
    }
}