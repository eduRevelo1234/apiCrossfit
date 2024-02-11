<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Libs\ResultResponse;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $usuario = User::all();
        $resultResponse = new ResultResponse();
        $resultResponse->setData($usuario);
        $resultResponse->setStatusCode(ResultResponse::SUCCESS_CODE);
        $resultResponse->setMessage(ResultResponse::TXT_SUCCESS_CODE);
        return response()->json($resultResponse);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $resultResponse = new ResultResponse();
        // Validar los campos del request
        $validation = $this->validateRequest($request);
        if ($validation->fails()) {
            $errors = $validation->errors()->all();
            $resultResponse->setStatusCode(ResultResponse::ERROR_CODE);
            $resultResponse->setMessage(implode(', ', $errors));
        } else {
            try {
                // Crear un nuevo usuario solo si la validación es exitosa
                $newUser = new User([
                    'us_cedula' => $request->get('us_cedula'),
                    'us_nombre' => $request->get('us_nombre'),
                    'us_apellidos' => $request->get('us_apellidos'),
                    'us_contraseña' => $request->get('us_contraseña'),
                    'us_estado' => $request->get('us_estado'),
                    'us_email' => $request->get('us_email'),
                    'us_fregistro' => $request->get('us_fregistro'),
                    'us_telefono' => $request->get('us_telefono'),
                    'us_celular' => $request->get('us_celular'),
                    'us_fnacimiento' => $request->get('us_fnacimiento'),
                    'us_direccion' => $request->get('us_direccion'),
                    'us_sexo' => $request->get('us_sexo'),
                    'us_rl_codigo' => $request->get('us_rl_codigo'),
                ]);
                $newUser->save();
                $resultResponse->setData($newUser);
                $resultResponse->setStatusCode(ResultResponse::SUCCESS_CODE);
                $resultResponse->setMessage(ResultResponse::TXT_SUCCESS_CODE);
            } catch (\Exception $e) {
                $resultResponse->setStatusCode(ResultResponse::ERROR_CODE);
                $resultResponse->setMessage(ResultResponse::TXT_ERROR_CODE);
            }
        }
        return response()->json($resultResponse);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $resultResponse = new ResultResponse();
        $validation = $this->validateUserId($id);
        if ($validation->fails()) {
            $errors = $validation->errors()->all();
            $resultResponse->setStatusCode(ResultResponse::ERROR_CODE);
            $resultResponse->setMessage(implode(', ', $errors));
        } else {
            try {
                $user = User::findOrFail($id);
                $resultResponse->setData($user);
                $resultResponse->setStatusCode(ResultResponse::SUCCESS_CODE);
                $resultResponse->setMessage(ResultResponse::TXT_SUCCESS_CODE);
            } catch (\Exception $e) {
                $resultResponse->setStatusCode(ResultResponse::ERROR_ELEMENT_NOT_FOUND_CODE);
                $resultResponse->setMessage(ResultResponse::TXT_ERROR_ELEMENT_NOT_FOUND_CODE);
            }
        }
        return response()->json($resultResponse);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $resultResponse = new ResultResponse();
        // Validar los campos del request
        $validation = $this->validateRequest($request);
        if ($validation->fails()) {
            $errors = $validation->errors()->all();
            $resultResponse->setStatusCode(ResultResponse::ERROR_CODE);
            $resultResponse->setMessage(implode(', ', $errors));
        } else {
            try {
                $user = User::findOrFail($id);
                $user->us_cedula = $request->get('us_cedula', $user->us_cedula);
                $user->us_nombre = $request->get('us_nombre', $user->us_nombre);
                $user->us_apellidos = $request->get('us_apellidos', $user->us_apellidos);
                $user->us_contraseña = $request->get('us_contraseña', $user->us_contraseña);
                $user->us_estado = $request->get('us_estado', $user->us_estado);
                $user->us_email = $request->get('us_email', $user->sc_us_codigo);
                $user->us_fregistro = $request->get('us_fregistro', $user->us_fregistro);
                $user->us_telefono = $request->get('us_telefono', $user->us_telefono);
                $user->us_celular = $request->get('us_celular', $user->us_celular);
                $user->us_fnacimiento = $request->get('us_fnacimiento', $user->us_fnacimiento);
                $user->us_direccion = $request->get('us_direccion', $user->us_direccion);
                $user->us_sexo = $request->get('us_sexo', $user->us_sexo);
                $user->us_rl_codigo = $request->get('us_rl_codigo', $user->us_rl_codigo);
                $user->save();
                $resultResponse->setData($user);
                $resultResponse->setStatusCode(ResultResponse::SUCCESS_CODE);
                $resultResponse->setMessage(ResultResponse::TXT_SUCCESS_CODE);
            } catch (\Exception $e) {
                $resultResponse->setStatusCode(ResultResponse::ERROR_CODE);
                $resultResponse->setMessage(ResultResponse::TXT_ERROR_CODE);
            }
        }
        return response()->json($resultResponse);
    }

    /**
     * Update the specified resource in storage.
     */
    public function put(Request $request, $id)
    {
        $resultResponse = new ResultResponse();
        try {
            $user = User::findOrFail($id);
            $user->us_cedula = $request->get('us_cedula', $user->us_cedula);
            $user->us_nombre = $request->get('us_nombre', $user->us_nombre);
            $user->us_apellidos = $request->get('us_apellidos', $user->us_apellidos);
            $user->us_contraseña = $request->get('us_contraseña', $user->us_contraseña);
            $user->us_estado = $request->get('us_estado', $user->us_estado);
            $user->us_email = $request->get('us_email', $user->sc_us_codigo);
            $user->us_fregistro = $request->get('us_fregistro', $user->us_fregistro);
            $user->us_telefono = $request->get('us_telefono', $user->us_telefono);
            $user->us_celular = $request->get('us_celular', $user->us_celular);
            $user->us_fnacimiento = $request->get('us_fnacimiento', $user->us_fnacimiento);
            $user->us_direccion = $request->get('us_direccion', $user->us_direccion);
            $user->us_sexo = $request->get('us_sexo', $user->us_sexo);
            $user->us_rl_codigo = $request->get('us_rl_codigo', $user->us_rl_codigo);
            $user->save();
            $resultResponse->setData($user);
            $resultResponse->setStatusCode(ResultResponse::SUCCESS_CODE);
            $resultResponse->setMessage(ResultResponse::TXT_SUCCESS_CODE);
        } catch (\Exception $e) {
            $resultResponse->setStatusCode(ResultResponse::ERROR_CODE);
            $resultResponse->setMessage(ResultResponse::TXT_ERROR_CODE);
        }
        return response()->json($resultResponse);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $resultResponse = new ResultResponse();
        $validation = $this->validateUserId($id);
        if ($validation->fails()) {
            $errors = $validation->errors()->all();
            $resultResponse->setStatusCode(ResultResponse::ERROR_CODE);
            $resultResponse->setMessage(implode(', ', $errors));
        } else {
            try {
                $user = User::findOrFail($id);
                $user->delete();
                $resultResponse->setData($user);
                $resultResponse->setStatusCode(ResultResponse::SUCCESS_CODE);
                $resultResponse->setMessage(ResultResponse::TXT_SUCCESS_CODE);
            } catch (\Exception $e) {
                $resultResponse->setStatusCode(ResultResponse::ERROR_CODE);
                $resultResponse->setMessage(ResultResponse::TXT_ERROR_CODE);
            }
        }
        return response()->json($resultResponse);
    }

    public function search(Request $request)
    {
        $resultResponse = new ResultResponse();
        try {
            // Obtener todos los usuarios
            $users = User::query();
            // Aplicar búsqueda si se proporciona un término de búsqueda
            if ($request->has('search_term')) {
                $searchTerm = $request->input('search_term');
                // Filtrar usuarios que coincidan con el término de búsqueda en cualquiera de los campos
                $users->where('id', $searchTerm)
                    ->orWhere(function ($query) use ($searchTerm) {
                        $query->where('us_cedula', 'like', "%{$searchTerm}%")
                            ->orWhere('us_nombre', 'like', "%{$searchTerm}%")
                            ->orWhere('us_apellidos', 'like', "%{$searchTerm}%")
                            ->orWhere('us_sexo', 'like', "%{$searchTerm}%")
                            ->orWhere('us_email', 'like', "%{$searchTerm}%");
                    });
            }
            $resultResponse->setData($users->get());
            $resultResponse->setStatusCode(ResultResponse::SUCCESS_CODE);
            $resultResponse->setMessage(ResultResponse::TXT_SUCCESS_CODE);
        } catch (\Exception $e) {
            $resultResponse->setStatusCode(ResultResponse::ERROR_CODE);
            $resultResponse->setMessage(ResultResponse::TXT_ERROR_CODE);
        }
        return response()->json($resultResponse);
    }

    public function validateLogIn(Request $request)
    {
        $resultResponse = new ResultResponse();
        try {
            $validation = $this->validateRequestCredentials($request);

            if ($validation->fails()) {
                $errors = $validation->errors()->all();
                $resultResponse->setStatusCode(ResultResponse::ERROR_CODE);
                $resultResponse->setMessage(implode(', ', $errors));
            } else {
                $mail = $request->input('us_email');
                $password = $request->input('us_contraseña');
                $resultResponse->setData($this->validateCredentials($mail, $password));
                $resultResponse->setStatusCode(ResultResponse::SUCCESS_CODE);
                $resultResponse->setMessage(ResultResponse::TXT_SUCCESS_CODE);
            }
        } catch (\Exception $e) {
            $resultResponse->setStatusCode(ResultResponse::ERROR_CODE);
            $resultResponse->setMessage(ResultResponse::TXT_ERROR_CODE);
        }
        return response()->json($resultResponse);
    }

    private function validateRequest(Request $request)
    {
        $rules = [
            'us_cedula' => 'required|string|regex:/^[0-9]{1,10}$/',
            'us_nombre' => 'nullable|string|max:20',
            'us_apellidos' => 'nullable|string|max:30',
            'us_contraseña' => 'required|string|max:8',
            'us_estado' => 'required|string|max:10',
            'us_email' => 'required|email|max:255',
            'us_fregistro' => 'nullable|date_format:Y-m-d',
            'us_telefono' => 'nullable|string|max:20',
            'us_celular' => 'nullable|string|max:20',
            'us_fnacimiento' => 'nullable|date_format:Y-m-d',
            'us_direccion' => 'nullable|string|max:255',
            'us_sexo' => 'required|string|max:10',
            'us_rl_codigo' => ['required', 'integer', Rule::exists('rols', 'id')],
        ];
        return Validator::make($request->all(), $rules);
    }

    private function validateUserId($id)
    {
        return Validator::make(['id' => $id], [
            'id' => [
                'required',
                'integer',
                Rule::exists('users', 'id'),
            ],
        ]);
    }
    private function validateCredentials($mail, $password)
    {
        $user = User::where('us_email', $mail)->first();
        if ($user && $user->us_contraseña === $password) {
            return true;
        }
        return false;
    }

    private function validateRequestCredentials(Request $request)
    {
        $rules = [
            'us_email' => 'required|email|max:255',
            'us_contraseña' => 'required|string|max:8',
        ];
        return Validator::make($request->all(), $rules);
    }
}
