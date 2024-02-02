<?php

namespace App\Http\Controllers;

use App\Models\Rol;
use Illuminate\Http\Request;
use App\Libs\ResultResponse;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class RolController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rol = Rol::all();
        $resultResponse = new ResultResponse();
        $resultResponse->setData($rol);
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
        try {
            // Validar los campos del request
            $validation = $this->validateRolRequest($request);
            if ($validation->fails()) {
                $errors = $validation->errors()->all();
                $resultResponse->setStatusCode(ResultResponse::ERROR_CODE);
                $resultResponse->setMessage(implode(', ', $errors));
            } else {
                // Crear un nuevo rol solo si la validación es exitosa
                $newRol = new Rol([
                    'rl_nombre' => $request->input('name'),
                    'rl_descripcion' => $request->input('description'),
                ]);
                $newRol->save();
                $resultResponse->setData($newRol);
                $resultResponse->setStatusCode(ResultResponse::SUCCESS_CODE);
                $resultResponse->setMessage(ResultResponse::TXT_SUCCESS_CODE);
            }
        } catch (\Exception $e) {
            $resultResponse->setStatusCode(ResultResponse::ERROR_CODE);
            $resultResponse->setMessage(ResultResponse::TXT_ERROR_CODE);
        }
        return response()->json($resultResponse);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $resultResponse = new ResultResponse();
        $validation = $this->validateRolId($id);
        if ($validation->fails()) {
            $errors = $validation->errors()->all();
            $resultResponse->setStatusCode(ResultResponse::ERROR_CODE);
            $resultResponse->setMessage(implode(', ', $errors));
        } else {
            try {
                $rol = Rol::findOrFail($id);
                $resultResponse->setData($rol);
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
     * Show the form for editing the specified resource.
     */
    public function put(Request $request, $id)
    {
        $resultResponse = new ResultResponse();
        $validation = $this->validateRolRequest($request);
        if ($validation->fails()) {
            $errors = $validation->errors()->all();
            $resultResponse->setStatusCode(ResultResponse::ERROR_CODE);
            $resultResponse->setMessage(implode(', ', $errors));
        } else {
            try {
                $rol = Rol::findOrFail($id);
                $rol->rl_nombre = $request->get('rl_nombre', $rol->rl_nombre);
                $rol->rl_descripcion = $request->get('rl_descripcion', $rol->rl_descripcion);
                $rol->save();
                $resultResponse->setData($rol);
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
    public function update(Request $request, $id)
    {
        $resultResponse = new ResultResponse();
        $validation = $this->validateRolRequest($request);
        if ($validation->fails()) {
            $errors = $validation->errors()->all();
            $resultResponse->setStatusCode(ResultResponse::ERROR_CODE);
            $resultResponse->setMessage(implode(', ', $errors));
        } else {
            try {
                $rol = Rol::findOrFail($id);
                $rol->rl_nombre = $request->get('rl_nombre', $rol->rl_nombre);
                $rol->rl_descripcion = $request->get('rl_descripcion', $rol->rl_descripcion);
                $rol->save();
                $resultResponse->setData($rol);
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
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $resultResponse = new ResultResponse();
        $validation = $this->validateRolId($id);
        if ($validation->fails()) {
            $errors = $validation->errors()->all();
            $resultResponse->setStatusCode(ResultResponse::ERROR_CODE);
            $resultResponse->setMessage(implode(', ', $errors));
        } else {
            try {
                $rol = Rol::findOrFail($id);
                $rol->delete();
                $resultResponse->setData($rol);
                $resultResponse->setStatusCode(ResultResponse::SUCCESS_CODE);
                $resultResponse->setMessage(ResultResponse::TXT_SUCCESS_CODE);
            } catch (\Exception $e) {
                $resultResponse->setStatusCode(ResultResponse::ERROR_CODE);
                $resultResponse->setMessage(ResultResponse::TXT_ERROR_CODE);
            }
        }
        return response()->json($resultResponse);
    }

    private function validateRolRequest(Request $request)
    {
        $rules = [
            'name' => 'required|string|max:20',
            'description' => 'nullable|string|max:255',
        ];
        return Validator::make($request->all(), $rules);
    }
    private function validateRolId($id)
    {
        return Validator::make(['id' => $id], [
            'id' => [
                'required',
                'integer',
                Rule::exists('rutines', 'id'),
            ],
        ]);
    }
}
