<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\auth\LoginRequest;
use App\Http\Requests\auth\RegisterRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

/**
 * Gestiona el registro y la autenticación de usuarios.
 */
class UserController extends Controller{

    /**
     * Valida las credenciales e inicia sesión creando un token.
     */
    public function login(LoginRequest $request){

        $response = [
            'status' => 'error',
            'message'=>'Error_Default',
            'data' => null,
            'error'=> false
        ];
       
        $data = $request->validated(); //Devuelve un array

        $user = User::where('email', $data['email'])->first();
        
        if(!$user || !Hash::check($data['password'], $user->password)){


            $response['message']= 'Credenciales incorrectas';
            return response()->json($response, 401);
        }

        $token = $user->createToken('Default_Name');
        $response['data'] = ['token' => $token->plainTextToken, 'user'=> new UserResource($user)];
        $response['status'] = 'exito';
        $response['message'] = 'Login exitoso';
        return response()->json($response,200);
    }

    /**
     * Registra un usuario nuevo.
     */
    public function register(RegisterRequest $request){

        $response = [
            'status' => 'error',
            'message'=>'Error_Default',
            'data' => null,
            'error'=> false
        ];

        $data = $request->validated(); // Este ya valida la doble contraseña Y EL EMAIL

        $newUser = User::create($data);
        $response['message'] = 'Registro exitoso';
        $response['status'] = 'exito';
        $response['data'] = new UserResource($newUser);
        return response()->json($response, 201);
        

    }

    /**
     * Revoca los tokens del usuario autenticado.
     */
    public function logout(Request $request){
        $response = [
            'status' => 'exito',
            'message'=>'Logout exitoso.',
            'data' => null,
            'error'=> false
        ];
        $user = $request->user();
        $user->tokens()->delete();
        return response()->json($response, 200);
    }
}