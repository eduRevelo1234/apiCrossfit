<?php

namespace App\Http\Controllers;

use App\Models\Clase;
use Illuminate\Http\Request;
use App\Libs\ResultResponse;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ClaseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clase = Clase::all();
        $resultResponse = new ResultResponse();
        $resultResponse->setData($clase);
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
        $validation = $this->validateRequest($request);
        if ($validation->fails()) {
            $errors = $validation->errors()->all();
            $resultResponse->setStatusCode(ResultResponse::ERROR_CODE);
            $resultResponse->setMessage(implode(', ', $errors));
        } else {
            try {
                $newClase = new Clase([
                    'cl_nombre' => $request->get('cl_nombre'),
                    'cl_fecha' => $request->get('cl_fecha'),
                    'cl_hora' => $request->get('cl_hora'),
                    'cl_maximo' => $request->get('cl_maximo'),
                    'cl_actual' => $request->get('cl_actual'),
                    'cl_rt_code' => $request->get('cl_rt_code'),
                ]);
                $newClase->save();
                $resultResponse->setData($newClase);
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
        $validation = $this->validateId($id);
        if ($validation->fails()) {
            $errors = $validation->errors()->all();
            $resultResponse->setStatusCode(ResultResponse::ERROR_CODE);
            $resultResponse->setMessage(implode(', ', $errors));
        } else {
            try {
                $clase = Clase::findOrFail($id);
                $resultResponse->setData($clase);
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
    public function update(Request $request, $id)
    {
        $resultResponse = new ResultResponse();
        $validation = $this->validateRequest($request);
        if ($validation->fails()) {
            $errors = $validation->errors()->all();
            $resultResponse->setStatusCode(ResultResponse::ERROR_CODE);
            $resultResponse->setMessage(implode(', ', $errors));
        } else {
            try {
                $clase = Clase::findOrFail($id);
                $clase->cl_nombre = $request->get('cl_nombre', $clase->cl_nombre);
                $clase->cl_fecha = $request->get('cl_fecha', $clase->cl_fecha);
                $clase->cl_hora = $request->get('cl_hora', $clase->cl_hora);
                $clase->cl_maximo = $request->get('l_maximo', $clase->l_maximo);
                $clase->cl_actual = $request->get('cl_actual', $clase->cl_actual);
                $clase->cl_rt_code = $request->get('cl_rt_code', $clase->cl_rt_code);
                $clase->save();
                $resultResponse->setData($clase);
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
            $clase = Clase::findOrFail($id);
            $clase->cl_nombre = $request->get('cl_nombre', $clase->cl_nombre);
            $clase->cl_fecha = $request->get('cl_fecha', $clase->cl_fecha);
            $clase->cl_hora = $request->get('cl_hora', $clase->cl_hora);
            $clase->cl_maximo = $request->get('l_maximo', $clase->l_maximo);
            $clase->cl_actual = $request->get('cl_actual', $clase->cl_actual);
            $clase->cl_rt_code = $request->get('cl_rt_code', $clase->cl_rt_code);
            $clase->save();
            $resultResponse->setData($clase);
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
        $validation = $this->validateId($id);
        if ($validation->fails()) {
            $errors = $validation->errors()->all();
            $resultResponse->setStatusCode(ResultResponse::ERROR_CODE);
            $resultResponse->setMessage(implode(', ', $errors));
        } else {
            try {
                $clase = Clase::findOrFail($id);
                $clase->delete();
                $resultResponse->setData($clase);
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
            // Obtener todas las clases
            $clases = Clase::all();

            // Aplicar búsqueda si se proporciona un término de búsqueda
            if ($request->has('search_term')) {
                $searchTerm = strtolower($request->input('search_term'));

                // Filtrar clases que coincidan con el término de búsqueda en cualquiera de los campos
                $clases = $clases->filter(function ($clase) use ($searchTerm) {
                    foreach ($clase->toArray() as $field => $value) {
                        if (is_string($value) && str_contains(strtolower($value), $searchTerm)) {
                            return true;
                        }
                    }
                    return false;
                });
            }

            $resultResponse->setData($clases);
            $resultResponse->setStatusCode(ResultResponse::SUCCESS_CODE);
            $resultResponse->setMessage(ResultResponse::TXT_SUCCESS_CODE);
        } catch (\Exception $e) {
            $resultResponse->setStatusCode(ResultResponse::ERROR_CODE);
            $resultResponse->setMessage(ResultResponse::TXT_ERROR_CODE);
        }

        return response()->json($resultResponse);
    }

    private function validateRequest(Request $request)
    {
        // Reglas de validación
        $rules = [
            'cl_nombre' => 'required|string|max:255',
            'cl_fecha' => 'nullable|date|date_format:Y-m-d',
            'cl_hora' => 'nullable|date_format:H:i:s',
            'cl_maximo' => 'nullable|integer',
            'cl_actual' => 'nullable|integer',
            'cl_rt_code' => ['required', 'integer', Rule::exists('routines', 'id')],
        ];
        return Validator::make($request->all(), $rules);
    }

    private function validateId($id)
    {
        return Validator::make(['id' => $id], [
            'id' => [
                'required',
                'integer',
                Rule::exists('clases', 'id'),
            ],
        ]);
    }
}
