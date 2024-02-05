<?php

namespace App\Http\Controllers;

use App\Models\Result;
use Illuminate\Http\Request;
use App\Libs\ResultResponse;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ResultController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $result = Result::all();
        $resultResponse = new ResultResponse();
        $resultResponse->setData($result);
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
                $newPlan = new Result([
                    'rl_fecha' => $request->get('rl_fecha'),
                    'rl_observacion' => $request->get('rl_observacion'),
                    'rl_rondas' => $request->get('rl_rondas'),
                    'rl_repeticion' => $request->get('rl_repeticion'),
                    'rl_peso' => $request->get('rl_peso'),
                    'rl_unidad' => $request->get('rl_unidad'),
                    'rl_us_codigo' => $request->get('rl_us_codigo'),
                    'rl_ej_codigo' => $request->get('rl_ej_codigo'),
                ]);
                $newPlan->save();
                $resultResponse->setData($newPlan);
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
                $result = Result::findOrFail($id);
                $resultResponse->setData($result);
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
                $result = Result::findOrFail($id);
                $result->rl_fecha = $request->get('rl_fecha', $result->rl_fecha);
                $result->rl_observacion = $request->get('rl_observacion', $result->rl_observacion);
                $result->rl_rondas = $request->get('rl_rondas', $result->rl_rondas);
                $result->rl_repeticion = $request->get('rl_repeticion', $result->rl_repeticion);
                $result->rl_peso = $request->get('rl_peso', $result->rl_peso);
                $result->rl_unidad = $request->get('rl_unidad', $result->rl_unidad);
                $result->rl_us_codigo = $request->get('rl_us_codigo', $result->rl_us_codigo);
                $result->rl_ej_codigo = $request->get('rl_ej_codigo', $result->rl_ej_codigo);
                $result->save();
                $resultResponse->setData($result);
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
            $result = Result::findOrFail($id);
            $result->rl_fecha = $request->get('rl_fecha', $result->rl_fecha);
            $result->rl_observacion = $request->get('rl_observacion', $result->rl_observacion);
            $result->rl_rondas = $request->get('rl_rondas', $result->rl_rondas);
            $result->rl_repeticion = $request->get('rl_repeticion', $result->rl_repeticion);
            $result->rl_peso = $request->get('rl_peso', $result->rl_peso);
            $result->rl_unidad = $request->get('rl_unidad', $result->rl_unidad);
            $result->rl_us_codigo = $request->get('rl_us_codigo', $result->rl_us_codigo);
            $result->rl_ej_codigo = $request->get('rl_ej_codigo', $result->rl_ej_codigo);
            $result->save();
            $resultResponse->setData($result);
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
                $result = Result::findOrFail($id);
                $result->delete();
                $resultResponse->setData($result);
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
            // Obtener todos los resultados
            $results = Result::all();

            // Aplicar búsqueda si se proporciona un término de búsqueda
            if ($request->has('search_term')) {
                $searchTerm = strtolower($request->input('search_term'));

                // Filtrar resultados que coincidan con el término de búsqueda en cualquiera de los campos
                $results = $results->filter(function ($result) use ($searchTerm) {
                    foreach ($result->getAttributes() as $field => $value) {
                        // Considerar solo campos de cadena y realizar una búsqueda insensible a mayúsculas y minúsculas
                        if (is_string($value) && str_contains(strtolower($value), $searchTerm)) {
                            return true;
                        }
                    }
                    return false;
                });
            }

            $resultResponse->setData($results);
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
            'rl_fecha' => 'required|date_format:Y-m-d',
            'rl_observacion' => 'required|string|max:255',
            'rl_rondas' => 'required|integer',
            'rl_repeticion' => 'required|integer',
            'rl_peso' => 'required|integer',
            'rl_unidad' => 'required|string|max:255',
            'rl_us_codigo' => ['required', 'integer', Rule::exists('users', 'id')],
            'rl_ej_codigo' => ['required', 'integer', Rule::exists('exercises', 'id')],
        ];
        return Validator::make($request->all(), $rules);
    }

    private function validateId($id)
    {
        return Validator::make(['id' => $id], [
            'id' => [
                'required',
                'integer',
                Rule::exists('results', 'id'),
            ],
        ]);
    }
}
